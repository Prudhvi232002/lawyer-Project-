<?php

namespace App\Http\Controllers\API\Customers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Http\Controllers\NotificationSettingsController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PaymentMethods\StripeController;
use App\Http\Requests\API\Customers\BookedServiceRequest;
use App\Http\Resources\API\BookedServicesResource;
use App\Models\ServiceSchedule;
use App\Models\ServiceScheduleSlot;
use App\Models\ServiceStatus;
use App\Models\ServiceType;
use App\Models\BookedService;
use App\Models\Service;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class CustomerBookedServicesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('api');
        $this->middleware('verified');
        $this->middleware('api_setting');
        $this->middleware('customer.api');
    }
    public function getter($req = null, $export = null)
    {

        $customer = auth()->user()->customer;
        if ($req != null) {
            $customer_services =  $customer->services()->withAll();
            if ($req->trash && $req->trash == 'with') {
                $customer_services =  $customer_services->withTrashed();
            }
            if ($req->trash && $req->trash == 'only') {
                $customer_services =  $customer_services->onlyTrashed();
            }
            if ($req->column && $req->column != null && $req->search != null) {
                $customer_services = $customer_services->whereLike($req->column, $req->search);
            } else if ($req->search && $req->search != null) {

                $customer_services = $customer_services->whereLike(['name', 'description'], $req->search);
            }
            if ($req->status_code) {
                $customer_services = $customer_services->where('service_status_code', $req->status_code);
            }

            if ($req->sort && $req->sort['field'] != null && $req->sort['type'] != null) {
                $customer_services = $customer_services->OrderBy($req->sort['field'], $req->sort['type']);
            } else {
                $customer_services = $customer_services->OrderBy('id', 'desc');
            }
            if ($export != null) { // for export do not paginate
                $customer_services = $customer_services->get();
                return $customer_services;
            }
            $totalCustomerServices = $customer_services->count();
            $customer_services = $customer_services->paginate($req->perPage);
            $customer_services = BookedServicesResource::collection($customer_services)->response()->getData(true);

            return $customer_services;
        }
        $customer_services = BookedServicesResource::collection($customer->services()->withAll()->orderBy('id', 'desc')->paginate(10))->response()->getData(true);
        return $customer_services;
    }

    public function bookService(BookedServiceRequest $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->all();
            $user = Auth()->user();
            $customer = $user->customer->id;
            $service = Service::where('id', $request->service_id)->first();

            $data['price'] = $service->price;
            $data['lawyer_id'] = $service->lawyer_id ?? null;
            $data['law_firm_id'] = $service->law_firm_id ?? null;
            $data['customer_id'] = $customer;
            $data['service_status_code'] = ServiceStatus::$Pending;
            if ($request->hasFile('attachment')) {
                $data['attachment_url'] = uploadFile($request, 'attachment', 'booked_services');
            }
            $request->merge(['amount' => $data['price'], 'type' => 'service']);

            $fund_request = PaymentController::addFundRequest($request);
            // dd($fund_request);
            $data['fund_id'] = $fund_request['fund']['id'] ?? null;
            if ($fund_request['fund'] ?? false) {
                $data['is_paid'] = 0;
                $service = BookedService::create($data);
                // $request->merge(['fee' => $data['fee']]);
                $service->fund_transaction = $fund_request['fund']->transaction ?? null;
                // $service->fund = $fund_request['fund'];
                $response = generateResponse($service, true, 'Service Booked Successfully', null, 'collection');
                $email_users = [
                    'customer' => $service->customer ? User::where('id', $service->customer->user_id)->first() : null,
                    'lawyer' => $service->lawyer ? User::where('id', $service->lawyer->user_id)->first() : null,
                ];
                NotificationSettingsController::fireNotificationEvent($service,'book_quick_service',$email_users,'service_log','Service Registered');

                DB::commit();
                return response()->json($response, 200);
            } else {
                $response = generateResponse($fund_request, false, 'Error', null, 'collection');
                return response()->json($response, 200);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            $response = generateResponse(null, false, $e->getMessage(), null, 'collection');
            return response()->json($response, 200);
        }
    }
    public function getFilteredServiceLogs(Request $request)
    {
        $services = $this->getter($request);
        $response = generateResponse($services, count($services['data']) > 0 ? true : false, 'Filter Service Logs Successfully', null, 'collection');
        return response()->json($response, 200);
    }
    public function showServiceLogDetail(BookedService $booked_service)
    {
        $user = Auth()->user();
        $service = BookedService::withAll()->find($booked_service->id);
        return ($booked_service->customer_id == $user->customer->id)
            ? response()->json(generateResponse(new BookedServicesResource($service), true, 'Service Fetched Successfully', null, 'collection'), 200)
            : response()->json(generateResponse(null, false, 'Service Not Found', null, 'collection'), 404);
    }
}
