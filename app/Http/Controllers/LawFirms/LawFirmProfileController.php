<?php

namespace App\Http\Controllers\LawFirms;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Http\Resources\Web\AppointmentSchedulesResource;
use App\Http\Resources\Web\AppointmentTypesResource;
use App\Http\Resources\Web\LawFirmsResource;
use App\Models\AppointmentSchedule;
use App\Models\AppointmentType;
use App\Models\BookAppointment;
use App\Models\Gateway;
use App\Models\LawFirm;

class LawFirmProfileController extends Controller
{
    public function __construct()
    {
    }

    public function myProfile(Request $request)
    {
        $user = auth()->user();
        $law_firm = $user->law_firm;
        $law_firm = LawFirm::withChildrens()->active()->withAll()->where('id', $law_firm->id)->first();
        if (!$law_firm) {
            abort(404);
        }
        $law_firm = new LawFirmsResource($law_firm);
        $appointment_types = AppointmentType::active()->get();
        $appointment_types = AppointmentTypesResource::collection($appointment_types);
        return Inertia::render('LawFirms/Profile', [
            'law_firm' => $law_firm,
            'appointment_types' => $appointment_types
        ]);
    }
    public function profile(Request $request)
    {
        $law_firm = LawFirm::withChildrens()->active()->approved()->withAll()->where('user_name', $request->user_name)->first();
        if (!$law_firm) {
            abort(404);
        }
        $law_firm->setRelation(
            'law_firm_lawyers',
            $law_firm->law_firm_lawyers->take(20)
        );
        $law_firm = new LawFirmsResource($law_firm);
        $appointment_types = AppointmentType::active()->get();
        $appointment_types = AppointmentTypesResource::collection($appointment_types);
        return Inertia::render('LawFirms/Profile', [
            'law_firm' => $law_firm,
            'appointment_types' => $appointment_types

        ]);
    }

    public function reviews(Request $request)
    {
        $law_firm = LawFirm::withChildrens()->active()->approved()->withAll()->where('user_name', $request->user_name)->first();
        if (!$law_firm) {
            abort(404);
        }
        $law_firm = new LawFirmsResource($law_firm);
        return Inertia::render('LawFirms/Reviews', [
            'law_firm' => $law_firm
        ]);
    }
    public function bookAppointment(Request $request, $user_name)
    {
        $law_firm = LawFirm::where('user_name', $user_name)->first();
        $law_firm_id = $law_firm->id;
        $appointment_type = AppointmentType::select('id', 'is_schedule_required')->where('type', $request->type)->first();
        $appointment_type_id = $appointment_type->id;
        $day = strtolower(Date('l'));
        $date = today();
        if ($appointment_type->is_schedule_required) {
            $schedule = AppointmentSchedule::with('appointment_type')->with('schedule_slots')->where('law_firm_id', $law_firm_id)->where('appointment_type_id', $appointment_type_id)->where('day', $day)->first();
        } else {
            $schedule = AppointmentSchedule::with('appointment_type')->with('schedule_slots')->where('law_firm_id', $law_firm_id)->where('appointment_type_id', $appointment_type_id)->first();
        }
        if ($schedule) {
            $scheduleSlots = $schedule->schedule_slots;
            if (count($scheduleSlots) > 0) {
                foreach ($scheduleSlots as $scheduleSlot) {
                    $is_disabled = BookAppointment::where('law_firm_id', $law_firm_id)
                        ->whereDate('date', $date)
                        ->where('is_paid', 1)
                        ->where(function ($q) use ($scheduleSlot) {
                            $q->where(function ($z) use ($scheduleSlot) {
                                $z->where('start_time', $scheduleSlot->start_time);
                                $z->where('end_time', $scheduleSlot->end_time);
                            });
                        })->count();

                    $scheduleSlot['is_disabled'] = $is_disabled;
                }
            }
            $schedule = new AppointmentSchedulesResource($schedule);
        } else {
            $schedule = null;
        }
        $gateways = Gateway::where('status', 1)->get();

        return Inertia::render('LawFirms/BookAppointment', [
            'schedule' => $schedule,
            'law_firm_id' => $law_firm_id,
            'law_firm' => $law_firm,
            'appointment_type_name' => $appointment_type->display_name,
            'appointment_type_id' => $appointment_type_id,
            'is_schedule_required' => $appointment_type->is_schedule_required,
            "gateways" => $gateways

        ]);
    }
}
