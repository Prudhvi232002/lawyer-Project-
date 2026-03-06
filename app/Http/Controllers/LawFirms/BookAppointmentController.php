<?php

namespace App\Http\Controllers\LawFirms;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Controllers\Controller;

use App\Http\Resources\Web\BookAppointmentsResource;
use App\Models\AppointmentStatus;
use App\Models\BookAppointment;
use App\Models\Commission;
use App\PusherBeam\PusherBeamService;
use Carbon\Carbon;

class BookAppointmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('law_firm');
    }
    public function getter($req = null, $export = null)
    {

        $law_firm = auth()->user()->law_firm;
        if ($req != null) {
            $law_firm_appointments =  $law_firm->appointments()->withAll();
            if ($req->trash && $req->trash == 'with') {
                $law_firm_appointments =  $law_firm_appointments->withTrashed();
            }
            if ($req->trash && $req->trash == 'only') {
                $law_firm_appointments =  $law_firm_appointments->onlyTrashed();
            }
            if ($req->column && $req->column != null && $req->search != null) {
                $law_firm_appointments = $law_firm_appointments->whereLike($req->column, $req->search);
            } else if ($req->search && $req->search != null) {

                $law_firm_appointments = $law_firm_appointments->whereLike(['name', 'description'], $req->search);
            }

            if ($req->status_code) {
                $law_firm_appointments = $law_firm_appointments->where('appointment_status_code', $req->status_code);
            }

            if ($req->sort && $req->sort['field'] != null && $req->sort['type'] != null) {
                $law_firm_appointments = $law_firm_appointments->OrderBy($req->sort['field'], $req->sort['type']);
            } else {
                $law_firm_appointments = $law_firm_appointments->OrderBy('id', 'desc');
            }
            if ($export != null) { // for export do not paginate
                $law_firm_appointments = $law_firm_appointments->get();
                return $law_firm_appointments;
            }
            $totalLawFirmAppointments = $law_firm_appointments->count();
            $law_firm_appointments = $law_firm_appointments->paginate($req->perPage);
            $law_firm_appointments = BookAppointmentsResource::collection($law_firm_appointments)->response()->getData(true);

            return $law_firm_appointments;
        }
        $law_firm_appointments = BookAppointmentsResource::collection($law_firm->appointments()->withAll()->orderBy('id', 'desc')->paginate(10))->response()->getData(true);
        return $law_firm_appointments;
    }
    public function getLawFirmsFilteredAppointmentlogs(Request $request)
    {
        $appointments = $this->getter($request);
        $response = generateResponse($appointments, count($appointments['data']) > 0 ? true : false, 'Filter Appointment Logs Successfully', null, 'collection');
        return response()->json($response, 200);
    }
    public function showLawFirmsAppointmentLogDetailPage($id)
    {
        $user = Auth()->user();
        $law_firm_id = $user->law_firm->id;
        $appointment = BookAppointment::withAll()->where('id', $id)->where('law_firm_id', $law_firm_id)->first();
        $appointment = new BookAppointmentsResource($appointment);
        $data = [
            'appointment' => $appointment,
        ];
        return Inertia::render('AppointmentLogDetail', $data);
    }
    public function updateAppointmentStatus(Request $request)
    {

        $settings = generalSettings();
        $user = Auth()->user();
        $law_firm_id = $user->law_firm->id;
        $appointment = BookAppointment::withAll()->where('id', $request->appointment_id)->where('law_firm_id', $law_firm_id)->first();
        $customer_id = $appointment->customer->id;
        if ($appointment) {
            $updated =  $appointment->update([
                'appointment_status_code' => $request->status_code
            ]);
            if ($request->status_code == AppointmentStatus::$Completed) {
                $appointment->update([
                    'ended_at' => Carbon::now(),
                ]);
            }
            if ($updated) {
                if ($request->status_code == AppointmentStatus::$Accepted) {
                    $title = 'Your Appointment has been Accepted';
                    $body = 'You have a new notification';
                    $deep_link = env('APP_URL') . '/appointment_log';
                }
                if ($request->status_code == AppointmentStatus::$Rejected) {
                    $title = 'Your Appointment has been Rejected';
                    $body = 'You have a new notification';
                    $deep_link = env('APP_URL') . '/appointment_log';
                }
                if ($request->status_code == AppointmentStatus::$Cancel) {

                    $title = 'Your Appointment has been Canceled';
                    $body = 'You have a new notification';
                    $deep_link = env('APP_URL') . '/appointment_log';
                }
                if ($request->status_code == AppointmentStatus::$Completed) {

                    $title = 'Your Appointment has been Completed';
                    $body = 'You have a new notification';
                    $deep_link = env('APP_URL') . '/appointment_log';
                    if ((int)$settings['enable_wallet_system']) {
                        if ($settings['commission_type'] == 'commission_base') {
                            $commission = Commission::where('appointment_type_id', $appointment->appointment_type_id)->first();
                            if ($commission && $commission->commission_type == 'fixed_rate') {
                                $commission_amount = $commission->rate ?? 0;
                                $final_amount = $appointment->fee - $commission_amount;
                            } else {
                                $rate = $commission->rate ?? 0;
                                $percentage_value = ($appointment->fee / 100) * $rate;
                                $commission_amount = $percentage_value;
                                $final_amount = $appointment->fee - $percentage_value;
                            }
                        } else {
                            $final_amount = $appointment->fee;
                        }
                        $meta = ['details' => 'Deposit on Completion of Appointment # ' . $appointment->id];

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
                    'message' => 'Appointment Accepted Successfully',
                ]);
            } elseif ($request->status_code == 3) {
                request()->session()->flash('alert', [
                    'type' => 'info',
                    'message' => 'Appointment Rejected Successfully',
                ]);
            } elseif ($request->status_code == 5) {
                request()->session()->flash('alert', [
                    'type' => 'info',
                    'message' => 'Appointment Mark as Completed Successfully',
                ]);
            }
            return redirect()->back();
        }
    }
    public function updateAppointmentStarted(Request $request)
    {

        $user = Auth()->user();
        $law_firm_id = $user->law_firm->id;
        $appointment = BookAppointment::withAll()->where('id', $request->appointment_id)->where('law_firm_id', $law_firm_id)->first();
        if ($appointment) {
            $updated =  $appointment->update([
                'started_at' => Carbon::now(),
            ]);

            $response = generateResponse(null, true, 'Appointment Joined Successfully', null, 'object');
            return response()->json($response, 200);
        }
    }
}
