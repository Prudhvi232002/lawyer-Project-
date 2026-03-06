<?php

namespace App\Http\Controllers\API\Lawyers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\Lawyers\Appointments\AddScheduleRequest;
use App\Http\Requests\API\Lawyers\Appointments\CreateRequest;
use App\Http\Requests\API\Lawyers\Appointments\DeleteRequest;
use App\Http\Resources\API\AppointmentSchedulesResource;
use App\Models\AppointmentSchedule;
use App\Models\AppointmentScheduleSlot;
use App\Models\BookAppointment;
use App\Http\Resources\API\BookAppointmentsResource;
use App\Models\AppointmentStatus;
use App\Models\Commission;
use App\PusherBeam\PusherBeamService;
use Illuminate\Support\Facades\DB;

class APILawyerAppointmentScheduleController extends Controller
{
    public function __construct()
    {
        $this->middleware(['api', 'auth:api', 'verified', 'api_setting']);
        $this->middleware('lawyer.api');
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

    public function getFilteredAppointmentlogs(Request $request)
    {
        $appointments = $this->getter($request);
        $response = generateResponse($appointments, count($appointments['data']) > 0 ? true : false, 'Filter Appointment Logs Successfully', null, 'collection');
        return response()->json($response, 200);
    }
    public function showAppointmentLogDetail(BookAppointment $book_appointment)
    {
        $user = Auth()->user();
        return ($book_appointment->lawyer_id == $user->lawyer->id)
            ? response()->json(generateResponse(new BookAppointmentsResource($book_appointment), true, 'Appointment Fetched Successfully', null, 'collection'), 200)
            : response()->json(generateResponse(null, false, 'Appointment Not Found', null, 'collection'), 404);
    }

    public function updateAppointmentStatus(Request $request, BookAppointment $book_appointment)
    {
        $request->validate([
            'appointment_status_code' => 'required|in:1,2,3,4,5',
        ]);
        $user = Auth()->user();
        $settings = generalSettings();

        if (($book_appointment->lawyer_id == $user->lawyer->id)) {
            $customer_id = $book_appointment->customer->id;
            $updated = $book_appointment->update([
                'appointment_status_code' => $request->appointment_status_code
            ]);
            if ($updated) {
                if ($request->appointment_status_code == AppointmentStatus::$Accepted) {
                    $title = 'Your Appointment has been Accepted';
                    $body = 'You have a new notification';
                    $deep_link = env('APP_URL') . '/appointment_log';
                }
                if ($request->appointment_status_code == AppointmentStatus::$Rejected) {
                    $title = 'Your Appointment has been Rejected';
                    $body = 'You have a new notification';
                    $deep_link = env('APP_URL') . '/appointment_log';
                }
                if ($request->appointment_status_code == AppointmentStatus::$Cancel) {

                    $title = 'Your Appointment has been Canceled';
                    $body = 'You have a new notification';
                    $deep_link = env('APP_URL') . '/appointment_log';
                }
                if ($request->appointment_status_code == AppointmentStatus::$Completed) {
                    $title = 'Your Appointment has been Completed';
                    $body = 'You have a new notification';
                    $deep_link = env('APP_URL') . '/appointment_log';
                    if ((int)$settings['enable_wallet_system']) {
                        if ($settings['commission_type'] == 'commission_base') {
                            $commission = Commission::where('appointment_type_id', $book_appointment->appointment_type_id)->first();
                            if ($commission && $commission->commission_type == 'fixed_rate') {
                                $commission_amount = $commission->rate ?? 0;
                                $final_amount = $book_appointment->fee - $commission_amount;
                            } else {
                                $rate = $commission->rate ?? 0;
                                $percentage_value = ($book_appointment->fee / 100) * $rate;
                                $commission_amount = $percentage_value;
                                $final_amount = $book_appointment->fee - $percentage_value;
                            }
                        } else {
                            $final_amount = $book_appointment->fee;
                        }
                        $meta = ['details' => 'Deposit on Completion of Appointment # ' . $book_appointment->id];

                        $user->deposit($final_amount, $meta);
                    }
                }
                $pusher = new PusherBeamService;
                $users = (string)$customer_id;
                $pusher->sendNotificationToUsers($users, $title, $body, $deep_link);
            }
        }
        $book_appointment = new BookAppointmentsResource($book_appointment);
        $response = generateResponse($book_appointment, isset($book_appointment) ? true : false, 'Appointment Status Updated Successfully', null, 'collection');
        return response()->json($response, 200);
    }

    public function saveAppointmentSchedule(CreateRequest $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->all();
            $user = Auth()->user();
            $lawyer_id = $user->lawyer->id;
            $data['lawyer_id'] = $lawyer_id;
            $general_settings = generalSettings();
            if ($general_settings['commission_type'] == 'commission_base') {
                $commission = Commission::where('appointment_type_id', $request->appointment_type_id)->first();
                if ($commission && $commission->commission_type == 'fixed_rate') {
                    $commission_amount = $commission->rate;
                    $final_amount = $request->fee + $commission->rate;
                } else {
                    $percentage_value = ($request->fee / 100) * $commission->rate;
                    $commission_amount = $percentage_value;
                    $final_amount = $request->fee + $percentage_value;
                }
            } else {
                $final_amount = $request->fee;
                $commission_amount = null;
            }
            if ($request->is_schedule_required) {
                $records = AppointmentSchedule::where('lawyer_id', $lawyer_id)->where('appointment_type_id', $request->appointment_type_id)->get();
                $schedule_ids = $records->pluck('id')->toArray();
                if ($records) {
                    AppointmentScheduleSlot::whereIn('schedule_id', $schedule_ids)->delete();
                    $records->each->delete();
                }

                foreach ($request->selected_days as $key => $day) {
                    $schedule =  AppointmentSchedule::create([
                        'lawyer_id' => $lawyer_id,
                        'appointment_type_id' => $request->appointment_type_id,
                        'fee' => $final_amount,
                        'commission_amont' => $commission_amount,
                        'day' => $day,
                        'is_holiday' => isset($request->generated_slots[$day]) ? count($request->generated_slots[$day]) > 0 ? 1 : 0 : 1,
                        'start_time' => $request->start_time,
                        'end_time' => $request->end_time,
                        'slot_duration' => $request->interval,
                    ]);
                    if (isset($request->generated_slots[$day])) {
                        foreach ($request->generated_slots[$day] as $key => $slot) {
                            AppointmentScheduleSlot::create(
                                [
                                    'schedule_id' => $schedule->id,
                                    'start_time' => $slot['start_time'],
                                    'end_time' => $slot['end_time'],
                                    'is_active' => $slot['is_active'],
                                ]
                            );
                        }
                    }
                }
                $response = generateResponse(null, true, 'Schedules have been added Successfully', null, 'collection');
            } else {
                AppointmentSchedule::where('lawyer_id', $lawyer_id)->where('appointment_type_id', $request->appointment_type_id)->delete();
                if ($request->fee) {
                    $data['commission_amont'] = $commission_amount;
                    $data['fee'] = $final_amount;
                    $schedule = AppointmentSchedule::create($data);
                    $response = generateResponse(null, true, 'Schedules have been added Successfully', null, 'collection');
                } else {
                    $response = generateResponse(null, true, 'Schedules have been added Successfully', null, 'collection');
                }
            }
            DB::commit();
            return response()->json($response, 200);
        } catch (\Exception $e) {
            DB::rollBack();
            $response = generateResponse(null, false, $e->getLine() . $e->getMessage(), null, 'collection');
            return response()->json($response, 200);
        }
    }
    public function getAppointmentSchedules(Request $request)
    {
        try {
            $request->validate([
                'appointment_type_id' => 'required|integer',
                'is_schedule_required' => 'required|integer',
            ]);
            $user = Auth()->user();
            if ($request->is_schedule_required) {
                $schedules = AppointmentSchedule::withAll()->where('lawyer_id', $user->lawyer->id)->where('appointment_type_id', $request->appointment_type_id)->get();
                $schedules = AppointmentSchedulesResource::collection($schedules)->keyBy('day');
                $response = generateResponse($schedules, true, "Appointment Schedules Fetched Successfully", null, 'collection');
            } else {
                $schedule = AppointmentSchedule::withAll()->where('lawyer_id', $user->lawyer->id)->where('appointment_type_id', $request->appointment_type_id)->first();
                if ($schedule) {
                    $schedule = new AppointmentSchedulesResource($schedule);
                } else {
                    $schedule = null;
                }
                $response = generateResponse($schedule, true, "Appointment Schedule Fetched Successfully", null, 'collection');
            }
            if ($response['data']->isEmpty()) {
                $response['data'] = null;
            }
            return response()->json($response, 200);
        } catch (\Exception $e) {
            DB::rollBack();
            $response = generateResponse(null, false, $e->getMessage(), null, 'collection');
            return response()->json($response, 200);
        }
    }
    public function getAppointmentCommission(Request $request)
    {
        $request->validate([
            'appointment_type_id' => 'required|integer',
        ]);

        $commission = Commission::where('appointment_type_id', $request->appointment_type_id)->first();
        $response = generateResponse($commission, true, "Commission Fetched Successfully", null, 'collection');
        return response()->json($response);
    }
    public function deleteAppointmentScheduleSlots(DeleteRequest $request)
    {
        try {
            DB::beginTransaction();
            $user = Auth()->user();
            $schedule = AppointmentSchedule::withAll()->where('lawyer_id', $user->lawyer->id)->where('appointment_type_id', $request->appointment_type_id)->where('day', $request->day)->first();
            $schedule->schedule_slots()->delete();
            $schedule->delete();
            $response = generateResponse(null, true, 'Schedule slots have been deleted Successfully', null, 'collection');
            DB::commit();
            return response()->json($response, 200);
        } catch (\Exception $e) {
            DB::rollBack();
            $response = generateResponse(null, false, $e->getMessage(), null, 'collection');
            return response()->json($response, 200);
        }
    }
    public function addNewAppointmentSchedule(AddScheduleRequest $request)
    {
        try {
            DB::beginTransaction();
            $user = Auth()->user();
            $lawyer_id = $user->lawyer->id;
            $general_settings = generalSettings();
            $schedule = AppointmentSchedule::withAll()->where('lawyer_id', $lawyer_id)->where('appointment_type_id', $request->appointment_type_id)->first();
            if ($general_settings['commission_type'] == 'commission_base') {
                $commission = Commission::where('appointment_type_id', $request->appointment_type_id)->first();
                if ($commission && $commission->commission_type == 'fixed_rate') {
                    $commission_amount = $commission->rate;
                } else {
                    $percentage_value = ($schedule->fee / 100) * $commission->rate;
                    $commission_amount = $percentage_value;
                }
            } else {
                $commission_amount = null;
            }
            $created = AppointmentSchedule::create([
                'lawyer_id' => $lawyer_id,
                'appointment_type_id' => $request->appointment_type_id,
                'fee' => $schedule->fee,
                'commission_amont' => $commission_amount,
                'day' => $request->day,
                'is_holiday' => count($request->generated_slots) > 0 ? 1 : 0,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
                'slot_duration' => $request->interval,
            ]);
            foreach ($request->generated_slots as $key => $slot) {
                AppointmentScheduleSlot::create(
                    [
                        'schedule_id' => $created->id,
                        'start_time' => $slot['start_time'],
                        'end_time' => $slot['end_time'],
                        'is_active' => $slot['is_active'],
                    ]
                );
            }
            $response = generateResponse($created, true, 'Schedules have been added Successfully', null, 'collection');
            DB::commit();
            return response()->json($response, 200);
        } catch (\Exception $e) {
            DB::rollBack();
            $response = generateResponse(null, false, $e->getMessage(), null, 'collection');
            return response()->json($response, 200);
        }
    }
}
