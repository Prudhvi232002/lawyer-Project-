<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Models\AppointmentStatus;
use App\Models\BookAppointment;
use App\Models\Customer;
use App\Models\Event;
use App\Models\HomeComponentOrders;
use App\Models\LawFirm;
use App\Models\Lawyer;

class HomeController extends Controller
{
    public function __construct()
    {
    }

    public function home(Request $request)
    {
        $totalUsers = Customer::count();
        $totalLawyers = Lawyer::has('user')->whereNotNull('user_name')->active()->approved()->count();
        $totalLawFirm = LawFirm::active()->approved()->count();
        $totalEvents = Event::active()->approved()->upcoming()->count();
        $totalAppointments = BookAppointment::where('appointment_status_code',AppointmentStatus::$Completed)->count();
        $components = HomeComponentOrders::active()->orderBy('sort_order')->pluck('name')->toArray();
        // dd($components);
        $data = [
            'total_users' => $totalUsers,
            'total_lawyers' => $totalLawyers,
            'total_law_frims' => $totalLawFirm,
            'total_events' => $totalEvents,
            'total_subscriptions' => $totalUsers,
            'total_appointments' => $totalAppointments,
            'components' => $components,
        ];
    
        return Inertia::render('Home',['dashboard_data' => $data]);
    }
}
