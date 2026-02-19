<?php

namespace App\Http\Controllers\Lawyers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Controllers\Controller;

use App\Http\Resources\Web\BookedServicesResource;
use App\Models\ServiceStatus;
use App\Models\BookedService;
use App\Models\Commission;
use App\Models\User;
use App\PusherBeam\PusherBeamService;
use Carbon\Carbon;

class BookedServicesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('lawyer');
    }
    public function getter($req = null, $export = null)
    {

        $lawyer = auth()->user()->lawyer;
        if ($req != null) {
            $lawyer_services =  $lawyer->services()->withAll();
            if ($req->trash && $req->trash == 'with') {
                $lawyer_services =  $lawyer_services->withTrashed();
            }
            if ($req->trash && $req->trash == 'only') {
                $lawyer_services =  $lawyer_services->onlyTrashed();
            }
            if ($req->column && $req->column != null && $req->search != null) {
                $lawyer_services = $lawyer_services->whereLike($req->column, $req->search);
            } else if ($req->search && $req->search != null) {

                $lawyer_services = $lawyer_services->whereLike(['name', 'description'], $req->search);
            }

            if ($req->status_code) {
                $lawyer_services = $lawyer_services->where('service_status_code', $req->status_code);
            }

            if ($req->sort && $req->sort['field'] != null && $req->sort['type'] != null) {
                $lawyer_services = $lawyer_services->OrderBy($req->sort['field'], $req->sort['type']);
            } else {
                $lawyer_services = $lawyer_services->OrderBy('id', 'desc');
            }
            if ($export != null) { // for export do not paginate
                $lawyer_services = $lawyer_services->get();
                return $lawyer_services;
            }
            $totallawyerServices = $lawyer_services->count();
            $lawyer_services = $lawyer_services->paginate($req->perPage);
            $lawyer_services = BookedServicesResource::collection($lawyer_services)->response()->getData(true);

            return $lawyer_services;
        }
        $lawyer_services = BookedServicesResource::collection($lawyer->services()->withAll()->orderBy('id', 'desc')->paginate(10))->response()->getData(true);
        return $lawyer_services;
    }
    public function getLawyerFilteredServiceLogs(Request $request)
    {
        $services = $this->getter($request);
        $response = generateResponse($services, count($services['data']) > 0 ? true : false, 'Filter Service Logs Successfully', null, 'collection');
        return response()->json($response, 200);
    }
    public function showlawyerServiceLogDetailPage($id)
    {
        $user = Auth()->user();
        $lawyer_id = $user->lawyer->id;
        $service = BookedService::withAll()->where('id', $id)->where('lawyer_id', $lawyer_id)->first();
        $service = new BookedServicesResource($service);
        $data = [
            'service' => $service,
        ];
        return Inertia::render('ServiceLogs/Detail', $data);
    }
    public function updateServiceStatus(Request $request)
    {
        $settings = generalSettings();
        $user = Auth()->user();
        $lawyer_id = $user->lawyer->id;
        $service = BookedService::withAll()->where('id', $request->service_id)->where('lawyer_id', $lawyer_id)->first();
        $customer_id = $service->customer->id;

        if ($service) {
            $updated =  $service->update([
                'service_status_code' => $request->status_code
            ]);
            if ($request->status_code == ServiceStatus::$Completed) {
                $service->update([
                    'ended_at' => Carbon::now(),
                ]);
            }
            if ($updated) {
                if ($request->status_code == ServiceStatus::$Accepted) {
                    $title = 'Your Service has been Accepted';
                    $body = 'You have a new notification';
                    $deep_link = env('APP_URL') . '/service_log';
                }
                if ($request->status_code == ServiceStatus::$Rejected) {
                    $title = 'Your Service has been Rejected';
                    $body = 'You have a new notification';
                    $deep_link = env('APP_URL') . '/service_log';
                }
                if ($request->status_code == ServiceStatus::$Cancel) {

                    $title = 'Your Service has been Canceled';
                    $body = 'You have a new notification';
                    $deep_link = env('APP_URL') . '/service_log';
                }
                if ($request->status_code == ServiceStatus::$Completed) {

                    $title = 'Your Service has been Completed';
                    $body = 'You have a new notification';
                    $deep_link = env('APP_URL') . '/service_log';
                    if ((int)$settings['enable_wallet_system']) {

                        if ($settings['commission_type'] == 'commission_base') {
                            $commission = Commission::where('service_type_id', $service->service_type_id)->first();
                            if ($commission && $commission->commission_type == 'fixed_rate') {
                                $commission_amount = $commission->rate ?? 0;
                                $final_amount = $service->fee - $commission_amount;
                            } else {
                                $rate = $commission->rate ?? 0;
                                $percentage_value = ($service->fee / 100) * $rate;
                                $commission_amount = $percentage_value;
                                $final_amount = $service->fee - $percentage_value;
                            }
                        } else {
                            $final_amount = $service->fee;
                        }
                        $meta = ['details' => 'Deposit on Completion of Service # ' . $service->id];

                        $user->deposit($final_amount, $meta);
                    }
                }
                $pusher = new PusherBeamService;
                $users = (string)$customer_id;
                $pusher->sendNotificationToUsers($users, $title, $body, $deep_link);
            }

            if ($request->status_code == 2) {
                request()->session()->flash('alert', [
                    'type' => 'info',
                    'message' => 'Service Accepted Successfully',
                ]);
            } elseif ($request->status_code == 3) {
                request()->session()->flash('alert', [
                    'type' => 'info',
                    'message' => 'Service Rejected Successfully',
                ]);
            } elseif ($request->status_code == 5) {
                request()->session()->flash('alert', [
                    'type' => 'info',
                    'message' => 'Service Mark as Completed Successfully',
                ]);
            }
            return redirect()->back();
        }
    }
    public function updateServiceStarted(Request $request)
    {
        $user = Auth()->user();
        $lawyer_id = $user->lawyer->id;
        $service = BookedService::withAll()->where('id', $request->service_id)->where('lawyer_id', $lawyer_id)->first();
        if ($service) {
            $updated =  $service->update([
                'started_at' => Carbon::now(),
            ]);

            $response = generateResponse(null, true, 'Service Joined Successfully', null, 'object');
            return response()->json($response, 200);
        }
    }
}
