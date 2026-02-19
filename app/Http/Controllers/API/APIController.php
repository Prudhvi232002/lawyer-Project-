<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Web\AppointmentSchedulesResource;
use App\Models\AppointmentSchedule;
use App\Models\BookAppointment;
use App\Models\Currency;
use App\Models\Gateway;
use App\Models\Language;
use App\Models\ThemeSetting;
use Carbon\Carbon;

class APIController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }


    public function getAllSettings()
    {
        $settings = generalSettings();
        $default_currency = Currency::where('is_default', 1)->first();
        $settings['default_currency'] = $default_currency;
        $response = generateResponse($settings, true, "Settings Fetched Successfully", null, 'collection');
        return response()->json($response);
    }
    public function getAllThemes()
    {
        $colors = ThemeSetting::active()->get();
        $response = generateResponse($colors, true, "Colors Fetched Successfully", null, 'collection');
        return response()->json($response);
    }
    public function getCountries(Request $request)
    {
        $countries = APIGeneralController::getCountries($request);
        $response = generateResponse($countries, true, "Countries Fetched Successfully", null, 'collection');
        return response()->json($response);
    }

    public function getStates(Request $request)
    {
        $request->validate(['country_id' => 'exists:countries,id']);
        $states = APIGeneralController::getStates($request);
        $response = generateResponse($states, true, "States Fetched Successfully", null, 'collection');
        return response()->json($response);
    }

    public function getEvents(Request $request)
    {
        $events = APIGeneralController::searchEvents($request);
        $response = generateResponse($events, true, "Events Fetched Successfully", null, 'collection');
        return response()->json($response);
    }

    public function getTestimonials(Request $request)
    {
        $testimonials = APIGeneralController::getTestimonials($request);
        $response = generateResponse($testimonials, true, "Testimonials Fetched Successfully", null, 'collection');
        return response()->json($response);
    }


    public function getPosts(Request $request)
    {
        $posts = APIGeneralController::searchPosts($request);
        $response = generateResponse($posts, true, "Posts Fetched Successfully", null, 'collection');
        return response()->json($response);
    }

    public function getArchives(Request $request)
    {
        $archives = APIGeneralController::searchArchives($request);
        $response = generateResponse($archives, true, "Archives Fetched Successfully", null, 'collection');
        return response()->json($response);
    }

    public function getBroadcasts(Request $request)
    {
        $broadcasts = APIGeneralController::searchBroadcasts($request);
        $response = generateResponse($broadcasts, true, "Broadcasts Fetched Successfully", null, 'collection');
        return response()->json($response);
    }

    public function getPodcasts(Request $request)
    {
        $podcasts = APIGeneralController::searchPodcasts($request);
        $response = generateResponse($podcasts, true, "Podcasts Fetched Successfully", null, 'collection');
        return response()->json($response);
    }

    public function getLawyers(Request $request)
    {
        // $request->validate(['country_id' => 'exists:countries,id']);
        $lawyers = APIGeneralController::searchLawyers($request);
        $response = generateResponse($lawyers, true, "Lawyers Fetched Successfully", null, 'collection');
        return response()->json($response);
    }


    public function getLawyerReviews(Request $request, $user_name)
    {
        $lawyer_reviews = APIGeneralController::searchLawyerReviews($request, $user_name);
        $response = generateResponse($lawyer_reviews, true, "Lawyer Reviews Fetched Successfully", null, 'collection');
        return response()->json($response);
    }
    public function getLawyerPodcasts(Request $request, $user_name)
    {
        $lawyer_podcasts = APIGeneralController::searchLawyerPodcasts($request, $user_name);
        $response = generateResponse($lawyer_podcasts, true, "Lawyer Podcasts Fetched Successfully", null, 'collection');
        return response()->json($response);
    }
    public function getLawyerBroadcasts(Request $request, $user_name)
    {
        $lawyer_broadcasts = APIGeneralController::searchLawyerBroadcasts($request, $user_name);
        $response = generateResponse($lawyer_broadcasts, true, "Lawyer Broadcasts Fetched Successfully", null, 'collection');
        return response()->json($response);
    }
    public function getLawFirmReviews(Request $request, $user_name)
    {
        $law_firm_reviews = APIGeneralController::searchLawFirmReviews($request, $user_name);
        $response = generateResponse($law_firm_reviews, true, "LawFirm Reviews Fetched Successfully", null, 'collection');
        return response()->json($response);
    }

    public function getLawFirms(Request $request)
    {
        // $request->validate(['country_id' => 'exists:countries,id']);
        $law_firms = APIGeneralController::searchLawFirms($request);
        $response = generateResponse($law_firms, true, "LawFirms Fetched Successfully", null, 'collection');
        return response()->json($response);
    }

    public function getLawFirmCategories(Request $request)
    {
        $law_firm_categories = APIGeneralController::getLawFirmCategories($request);
        $response = generateResponse($law_firm_categories, true, "LawFirm Categories Fetched Successfully", null, 'collection');
        return response()->json($response);
    }

    public function getBlogCategories(Request $request)
    {
        $blog_categories = APIGeneralController::getBlogCategories($request);
        $response = generateResponse($blog_categories, true, "Blog Categories Fetched Successfully", null, 'collection');
        return response()->json($response);
    }

    public function getTags(Request $request)
    {
        $tags = APIGeneralController::getTags($request);
        $response = generateResponse($tags, true, "Tags Fetched Successfully", null, 'collection');
        return response()->json($response);
    }

    public function getArchiveCategories(Request $request)
    {
        $archive_categories = APIGeneralController::getArchiveCategories($request);
        $response = generateResponse($archive_categories, true, "Blog Categories Fetched Successfully", null, 'collection');
        return response()->json($response);
    }

    public function getServiceCategories(Request $request)
    {
        $service_categories = APIGeneralController::getServiceCategories($request);
        $response = generateResponse($service_categories, true, "Service Categories Fetched Successfully", null, 'collection');
        return response()->json($response);
    }

    public function getServices(Request $request)
    {
        $services = APIGeneralController::searchServices($request);
        $response = generateResponse($services, true, "Services Fetched Successfully", null, 'collection');
        return response()->json($response);
    }

    public function getLawyerCategories(Request $request)
    {
        $lawyer_categories = APIGeneralController::getLawyerCategories($request);
        $response = generateResponse($lawyer_categories, true, "Lawyer All Categories Fetched Successfully", null, 'collection');
        return response()->json($response);
    }
    public function getLawyerMainCategoriesWithChildrens(Request $request)
    {
        $lawyer_main_categories = APIGeneralController::getLawyerMainCategoriesWithChildrens($request);
        $response = generateResponse($lawyer_main_categories, true, "Lawyer Main Categories with Childrens Fetched Successfully", null, 'collection');
        return response()->json($response);
    }

    public function getCities(Request $request)
    {
        $request->validate(['state_id' => 'exists:states,id']);
        $cities = APIGeneralController::getCities($request);
        $response = generateResponse($cities, true, "Cities Fetched Successfully", null, 'collection');
        return response()->json($response);
    }

    public function getFeaturedTags(Request $request)
    {
        $featured_tags = APIGeneralController::getFeaturedTags($request);
        $response = generateResponse($featured_tags, true, "Featured Tags Fetched Successfully", null, 'collection');
        return response()->json($response);
    }

    public function getFeaturedLawyers(Request $request)
    {
        $featured_lawyers = APIGeneralController::getFeaturedLawyers($request);
        $response = generateResponse($featured_lawyers, true, "Featured Lawyers Fetched Successfully", null, 'collection');
        return response()->json($response);
    }

    public function getTopRatedLawyers(Request $request)
    {
        $featured_lawyers = APIGeneralController::getTopRatedLawyers($request);
        $response = generateResponse($featured_lawyers, true, "Top Lawyers Fetched Successfully", null, 'collection');
        return response()->json($response);
    }

    public function getFeaturedEvents(Request $request)
    {
        $featured_events = APIGeneralController::getFeaturedEvents($request);
        $response = generateResponse($featured_events, true, "Featured Events Fetched Successfully", null, 'collection');
        return response()->json($response);
    }
    public function getSpotlightLawyers(Request $request)
    {
        $spotlight_lawyers = APIGeneralController::getSpotlightLawyers($request);
        $response = generateResponse($spotlight_lawyers, true, "Spotlight Lawyers Fetched Successfully", null, 'collection');
        return response()->json($response);
    }
    public function getFeaturedLawFirms(Request $request)
    {
        $featured_law_firms = APIGeneralController::getFeaturedLawFirms($request);
        $response = generateResponse($featured_law_firms, true, "Featured LawFirms Fetched Successfully", null, 'collection');
        return response()->json($response);
    }
    public function getCompanyPage(Request $request, $slug)
    {
        $company_page = APIGeneralController::getCompanyPage($request, $slug);
        $response = generateResponse($company_page, true, "Company Page $slug Fetched Successfully", null, 'collection');
        return response()->json($response);
    }
    public function getAppointmentScheduleSlots(Request $request)
    {
        // $lawyer_id = 2;
        $lawyer_id = $request->lawyer_id;
        $day = Carbon::parse($request->selected_date)->format('l');
        $day = strtolower($day);
        $date = Carbon::parse($request->selected_date);
        $schedule = AppointmentSchedule::with('schedule_slots')->where('lawyer_id', $lawyer_id)->where('appointment_type_id', $request->appointment_type_id)->where('day', $day)->first();
        if ($schedule) {
            $scheduleSlots = $schedule->schedule_slots;
            if (count($scheduleSlots) > 0) {
                foreach ($scheduleSlots as $scheduleSlot) {
                    $is_disabled = BookAppointment::where('lawyer_id', $lawyer_id)
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
        $response = generateResponse($schedule, true, "Appointment Schedule Slots Fetched Successfully", null, 'collection');
        return response()->json($response);
    }
    public function getLawFirmAppointmentScheduleSlots(Request $request)
    {
        $law_firm_id = $request->law_firm_id;
        $day = Carbon::parse($request->selected_date)->format('l');
        $day = strtolower($day);
        $date = Carbon::parse($request->selected_date);

        $schedule = AppointmentSchedule::with('schedule_slots')->where('law_firm_id', $law_firm_id)->where('appointment_type_id', $request->appointment_type_id)->where('day', $day)->first();
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
        $response = generateResponse($schedule, true, "Appointment Schedule Slots Fetched Successfully", null, 'collection');
        return response()->json($response);
    }
    public function getAppointmentTypes(Request $request)
    {
        $appointment_types = APIGeneralController::getAppointmentTypes($request);
        $response = generateResponse($appointment_types, true, "AppointmentTypes Fetched Successfully", null, 'collection');
        return response()->json($response);
    }
    public function getAppCarousels(Request $request)
    {
        $appointment_types = APIGeneralController::getAppCarousels($request);
        $response = generateResponse($appointment_types, true, "App Carousel Fetched Successfully", null, 'collection');
        return response()->json($response);
    }
    public function getAllGateways()
    {
        $gateways = Gateway::where('status', 1)->get();
        $response = generateResponse($gateways, true, "Gateways Fetched Successfully", null, 'collection');
        return response()->json($response);
    }
    public function getAllLanguages()
    {
        $languages = Language::active()->get();
        $response = generateResponse($languages, true, "languages Fetched Successfully", null, 'collection');
        return response()->json($response);
    }
}
