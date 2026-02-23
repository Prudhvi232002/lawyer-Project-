<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\BookAppointment;
use App\Models\LawFirm;
use App\Models\Lawyer;
use App\Models\User;
use App\Models\Customer;
use App\Models\Event;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function home(Request $request)
    {
        $totalLawyers = Lawyer::count();
        $totalLawFirms = LawFirm::count();
        $totalBookedAppointments = BookAppointment::count();
        $totalUsers = Customer::count();
        $totalBlogCategories = 15;
        $totalSubscriptions = DB::table('subscriptions')->count();
        $totalEvents = Event::count();
        $totalLowProfileLawyers = 0;
        $allLawyer = Lawyer::has('lawyer_reviews')->get();

        foreach ($allLawyer as $key => $lawyer) {
            $rating = $lawyer->lawyer_reviews()->avg('rating');
            if (!empty($rating) && $rating < 2) {
                $totalLowProfileLawyers++;
            }
        }
        $totalCompleteLawyerProfiles = User::whereHas('lawyer', function ($q) {
            $q->where('profile_completion_percentage', '>=', 25);
        })->count();
        $totalCompleteLawFirmProfiles = User::whereHas('law_firm', function ($q) {
            $q->where('profile_completion_percentage', '>=', 25);
        })->count();
        $allLawFirms = LawFirm::has('law_firm_reviews')->get();
        $totalLowProfileLawFirms = 0;
        foreach ($allLawFirms as $key => $law_firm) {
            $rating = $law_firm->law_firm_reviews()->avg('rating');
            if (!empty($rating) && $rating < 2) {
                $totalLowProfileLawFirms++;
            }
        }
        $recordsByMonthThisYear = DB::table('booked_appointments')
            ->selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as count')
            ->where('created_at', '>=', Carbon::now()->subMonths(6)->startOfMonth())
            ->where('created_at', '<=', Carbon::now()->endOfMonth())
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();
        $appointmentRecordsByMonthsKeyed = [
            'Total' => 0
        ];

        foreach ($recordsByMonthThisYear as $group) {
            $year = $group->year;
            $month = $group->month;
            $count = $group->count;

            $monthKey = Carbon::createFromDate($year, $month, 1)->format('F');

            $appointmentRecordsByMonthsKeyed[$monthKey] = $count;
            $appointmentRecordsByMonthsKeyed['Total'] = $count + $appointmentRecordsByMonthsKeyed['Total'];
        }
        $recordsByMonthLastYear = DB::table('booked_appointments')
            ->selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as count')
            ->where('created_at', '>=', Carbon::now()->subMonths(18)->startOfMonth())
            ->where('created_at', '<=', Carbon::now()->subMonths(12))
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();
        $appointmentRecordsByLasteYearMonthsKeyed = ['Total' => 0];

        foreach ($recordsByMonthLastYear as $group) {
            $year = $group->year;
            $month = $group->month;
            $count = $group->count;

            $monthKey = Carbon::createFromDate($year, $month, 1)->format('F');

            $appointmentRecordsByLasteYearMonthsKeyed[$monthKey] = $count;
            $appointmentRecordsByLasteYearMonthsKeyed['Total'] = $count + $appointmentRecordsByMonthsKeyed['Total'];
        }
        $currentWeekStart = Carbon::now()->startOfWeek();
        $currentWeekEnd = Carbon::now()->endOfWeek();
        $lastWeekStart = Carbon::now()->subWeek()->startOfWeek()->format('Y-m-d');
        $lastWeekEnd = Carbon::now()->subWeek()->endOfWeek()->format('Y-m-d');

        $currentWeekCustomers = DB::table('customers')
            ->selectRaw('DAYOFWEEK(created_at) as day, COUNT(*) as count')
            ->whereBetween('created_at', [$currentWeekStart, $currentWeekEnd])
            ->groupBy('day')
            ->orderBy('day')
            ->get();
        $tempCurrentWeekCustomers = [];
        foreach ($currentWeekCustomers as $group) {
            $day = $group->day . 'th';
            $count = $group->count;
            $tempCurrentWeekCustomers[$day] = $count;
        }
        $lastWeekCustomers = DB::table('customers')
            ->selectRaw('DAYOFWEEK(created_at) as day, COUNT(*) as count')
            ->whereBetween('created_at', [$lastWeekStart, $lastWeekEnd])
            ->groupBy('day')
            ->orderBy('day')
            ->get();
        $templastWeekCustomers = [];
        foreach ($lastWeekCustomers as $group) {
            $day = $group->day . 'th';
            $count = $group->count;
            $templastWeekCustomers[$day] = $count;
        }

        $data = [
            'totalUsers' => $totalUsers,
            'totalBookedAppointments' => $totalBookedAppointments,
            'totalBlogCategories' => $totalBlogCategories,
            'totalSubscriptions' => $totalSubscriptions,
            'totalLawyers' => $totalLawyers,
            'total_law_firms' => $totalLawFirms,
            'total_subscriptions' => $totalUsers,
            'totalLowProfileLawyers' => $totalLowProfileLawyers,
            'totalCompleteLawyerProfiles' => $totalCompleteLawyerProfiles,
            'totalCompleteLawFirmProfiles' => $totalCompleteLawFirmProfiles,
            'totalLowProfileUsers' => $totalLowProfileLawyers + $totalLowProfileLawFirms + $totalLowProfileLawFirms + $totalCompleteLawFirmProfiles,
            'totalLowProfileLawFirms' => $totalLowProfileLawFirms,
            'appointmentRecordsByMonthsKeyed' => $appointmentRecordsByMonthsKeyed,
            'appointmentRecordsByLasteYearMonthsKeyed' => $appointmentRecordsByLasteYearMonthsKeyed,
            'currentWeekCustomers' => $tempCurrentWeekCustomers,
            'lastWeekCustomers' => $templastWeekCustomers,
            'totalEvents' => $totalEvents,
        ];

        return view('super_admins.dashboard', compact('data'));
    }

    public function viewNotification(Request $request, $type)
    {
        if ($type == 'low_profile_lawyers') {
            /********* Get Low Profile Lawyers  **********/
            $allLawyers = Lawyer::has('lawyer_reviews')->get();
            $lawyer_ids = [];
            foreach ($allLawyers as $key => $lawyer) {
                $rating = $lawyer->lawyer_reviews()->avg('rating');
                if (!empty($rating) && $rating < 2) {
                    $lawyer_ids[] = $lawyer->id;
                }
            }
            $lawyers = Lawyer::whereIn('id', $lawyer_ids)->get();
            return view('super_admins.view_notifications_lawyers.index')->with('lawyers', $lawyers);
        } else if ($type == 'low_profile_law_firms') {
            /********* Get Low Profile LawFirms  **********/
            $allLawFirms = LawFirm::has('law_firm_reviews')->get();
            $law_firm_ids = [];
            foreach ($allLawFirms as $key => $law_firm) {
                $rating = $law_firm->law_firm_reviews()->avg('rating');
                if (!empty($rating) && $rating < 2) {
                    $law_firm_ids[] = $law_firm->id;
                }
            }
            $law_firms = LawFirm::whereIn('id', $law_firm_ids)->get();
            return view('super_admins.view_notifications_law_firms.index')->with('law_firms', $law_firms);
        } else if ($type == 'completed_lawyer_profiles') {
            /********* Get completed_lawyer_profiles  **********/
            $lawyers = Lawyer::where('profile_completion_percentage', '>=', 25)->get();
            return view('super_admins.view_notifications_lawyers.index')->with('lawyers', $lawyers);
        } else if ($type == 'completed_law_firm_profiles') {
            /********* Get completed_law_firm_profiles  **********/
            $law_firms = LawFirm::where('profile_completion_percentage', '>=', 25)->get();
            return view('super_admins.view_notifications_law_firms.index')->with('law_firms', $law_firms);
        }
    }
    public function notAllowed(Request $request)
    {
        return view('super_admins.not_allowed');
    }
}
