<?php

namespace App\Http\Controllers\Lawyers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Controllers\Controller;

use App\Http\Resources\Web\BookAppointmentsResource;
use App\Models\AppointmentStatus;
use App\Models\BookAppointment;
use App\Models\Commission;
use App\Models\User;
use App\Http\Controllers\NotificationSettingsController;

use App\PusherBeam\PusherBeamService;
use Carbon\Carbon;

class BookAppointmentController extends Controller
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
            $lawyer_appointments =  $lawyer->appointments()->withAll();
            if ($req->trash && $req->trash == 'with') {
                $lawyer_appointments =  $lawyer_appointments->withTrashed();
            }
            if ($req->trash && $req->trash == 'only') {
                $lawyer_appointments =  $lawyer_appointments->onlyTrashed();
            }
            if ($req->column && $req->column != null && $req->search != null) {
                $lawyer_appointments = $lawyer_appointments->whereLike($req->column, $req->search);
            } else if ($req->search && $req->search != null) {

                $lawyer_appointments = $lawyer_appointments->whereLike(['name', 'description'], $req->search);
            }

            if ($req->status_code) {
                $lawyer_appointments = $lawyer_appointments->where('appointment_status_code', $req->status_code);
            }

            if ($req->sort && $req->sort['field'] != null && $req->sort['type'] != null) {
                $lawyer_appointments = $lawyer_appointments->OrderBy($req->sort['field'], $req->sort['type']);
            } else {
                $lawyer_appointments = $lawyer_appointments->OrderBy('id', 'desc');
            }
            if ($export != null) { // for export do not paginate
                $lawyer_appointments = $lawyer_appointments->get();
                return $lawyer_appointments;
            }
            $totallawyerAppointments = $lawyer_appointments->count();
            $lawyer_appointments = $lawyer_appointments->paginate($req->perPage);
            $lawyer_appointments = BookAppointmentsResource::collection($lawyer_appointments)->response()->getData(true);

            return $lawyer_appointments;
        }
        $lawyer_appointments = BookAppointmentsResource::collection($lawyer->appointments()->withAll()->orderBy('id', 'desc')->paginate(10))->response()->getData(true);
        return $lawyer_appointments;
    }
    public function getlawyerFilteredAppointmentlogs(Request $request)
    {
        $appointments = $this->getter($request);
        $response = generateResponse($appointments, count($appointments['data']) > 0 ? true : false, 'Filter Appointment Logs Successfully', null, 'collection');
        return response()->json($response, 200);
    }
    public function showlawyerAppointmentLogDetailPage($id)
    {
        $user = Auth()->user();
        $lawyer_id = $user->lawyer->id;
        $appointment = BookAppointment::withAll()->where('id', $id)->where('lawyer_id', $lawyer_id)->first();
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
        $lawyer_id = $user->lawyer->id;
        $appointment = BookAppointment::withAll()->where('id', $request->appointment_id)->where('lawyer_id', $lawyer_id)->first();
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

                $email_users = [
                    'customer' => $appointment->customer ? User::where('id', $appointment->customer->user_id)->first() : null,
                    'lawyer' => $appointment->lawyer ? User::where('id', $appointment->lawyer->user_id)->first() : null,
                    // 'lawfirm' => User::where('id', $appointment->law_firm->user_id)->first(),
                ];
                NotificationSettingsController::fireNotificationEvent($appointment,'change_appointment_status',$email_users,$deep_link,$title);

                // NotificationSettingsController::fireNotificationEvent($appointment, 'change_appointment_status',$email_users, $deep_link, $title);



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
        $lawyer_id = $user->lawyer->id;
        $appointment = BookAppointment::withAll()->where('id', $request->appointment_id)->where('lawyer_id', $lawyer_id)->first();
        if ($appointment) {
            $updated =  $appointment->update([
                'started_at' => Carbon::now(),
            ]);
            NotificationSettingsController::fireNotificationEvent($appointment, 'change_appointment_status');

            $response = generateResponse(null, true, 'Appointment Joined Successfully', null, 'object');
            return response()->json($response, 200);
        }
    }
}
