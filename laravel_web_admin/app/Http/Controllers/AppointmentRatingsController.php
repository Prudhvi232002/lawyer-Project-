<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customers\AddLawyerRatingRequest;
use App\Models\AppointmentRating;
use App\Models\BookAppointment;

class AppointmentRatingsController extends Controller
{
    /********* Initialize Permission based Middlewares  ***********/
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function addAppointmentRating(AddLawyerRatingRequest $request)
    {
        $user = auth()->user();
        $customer = $user->customer;

        $appointment = BookAppointment::where('id', $request->booked_appointment_id)->first();
        $logged_in_as = $request->session()->get('logged_in_as');
        if ($logged_in_as == 'customer') {
            if ($appointment->customer_id != $customer->id) {
                request()->session()->flash('alert', [
                    'type' => 'error',
                    'message' => 'not authenticated',
                ]);
                return redirect()->route('appointment_log');
            }
            $fromable_id = $customer->id;
            $fromable_type = 'App\Models\Customer';
            if ($appointment->lawyer_id) {
                $to_id = $appointment->lawyer_id;
                $to_type = 'App\Models\Lawyer';
            }
            if ($appointment->law_firm_id) {
                $to_id = $appointment->law_firm_id;
                $to_type = 'App\Models\LawFirm';
            }
        } else {
            if ($logged_in_as == 'lawyer') {
                $lawyer = $user->lawyer;
                if ($appointment->lawyer_id != $lawyer->id) {
                    request()->session()->flash('alert', [
                        'type' => 'error',
                        'message' => 'not authenticated',
                    ]);
                    return redirect()->route('appointment_log');
                }

                $fromable_id = $lawyer->id;
                $fromable_type = 'App\Models\Lawyer';
            }
            if ($logged_in_as == 'law_firm') {
                $law_firm = $user->law_firm;
                if ($appointment->law_firm_id != $law_firm->id) {
                    request()->session()->flash('alert', [
                        'type' => 'error',
                        'message' => 'not authenticated',
                    ]);
                    return redirect()->route('appointment_log');
                }
                $fromable_id = $law_firm->id;
                $fromable_type = 'App\Models\LawFirm';
            }
            $to_id = $appointment->customer_id;
            $to_type = 'App\Models\Customer';
        }
        $data['fromable_id'] = $fromable_id;
        $data['fromable_type'] = $fromable_type;
        $data['to_id'] = $to_id;
        $data['to_type'] = $to_type;
        $data['booked_appointment_id'] = $request->booked_appointment_id;
        $data['comment'] = $request->comment;
        $data['rating'] = $request->rating;
        AppointmentRating::create($data);
        request()->session()->flash('alert', [
            'type' => 'success',
            'message' => 'Rating Added Successfully',
        ]);
        return redirect()->back()->withResponseData([
            'message' => 'Rating Added Successfully',
            'type' => 'success'
        ]);
    }
}
