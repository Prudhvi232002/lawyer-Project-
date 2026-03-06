<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\Lawyer;
use App\Models\State;
use App\Models\LawyerCategory;

class WebAPIController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function getCountries(Request $request){
        $countries = WebAPIGeneralController::getCountries($request);
        $response = generateResponse($countries,true,"Countries Fetched Successfully",null,'collection');
        return response()->json($response);
    }

    public function getStates(Request $request){
        $request->validate(['country_id' => 'exists:countries,id']);
        $states = WebAPIGeneralController::getStates($request);
        $response = generateResponse($states,true,"States Fetched Successfully",null,'collection');
        return response()->json($response);
    }

    public function getEvents(Request $request){
        $events = WebAPIGeneralController::searchEvents($request);
        $response = generateResponse($events,true,"Events Fetched Successfully",null,'collection');
        return response()->json($response);
    }

    public function getTestimonials(Request $request){
        $testimonials = WebAPIGeneralController::getTestimonials($request);
        $response = generateResponse($testimonials,true,"Testimonials Fetched Successfully",null,'collection');
        return response()->json($response);

    }


    public function getPosts(Request $request){
        $posts = WebAPIGeneralController::searchPosts($request);
        $response = generateResponse($posts,true,"Posts Fetched Successfully",null,'collection');
        return response()->json($response);
    }

    public function getArchives(Request $request){
        $archives = WebAPIGeneralController::searchArchives($request);
        $response = generateResponse($archives,true,"Archives Fetched Successfully",null,'collection');
        return response()->json($response);
    }

    public function getBroadcasts(Request $request){
        $broadcasts = WebAPIGeneralController::searchBroadcasts($request);
        $response = generateResponse($broadcasts,true,"Broadcasts Fetched Successfully",null,'collection');
        return response()->json($response);
    }

    public function getPodcasts(Request $request){
        $podcasts = WebAPIGeneralController::searchPodcasts($request);
        $response = generateResponse($podcasts,true,"Podcasts Fetched Successfully",null,'collection');
        return response()->json($response);
    }

    public function getServices(Request $request){
        $services = WebAPIGeneralController::searchServices($request);
        $response = generateResponse($services,true,"Services Fetched Successfully",null,'collection');
        return response()->json($response);
    }

    public function getLawyers(Request $request){
        // $request->validate(['country_id' => 'exists:countries,id']);
        $lawyers = WebAPIGeneralController::searchLawyers($request);
        $response = generateResponse($lawyers,true,"Lawyers Fetched Successfully",null,'collection');
        return response()->json($response);
    }


    public function getLawyerReviews(Request $request,$user_name){
        $lawyer_reviews = WebAPIGeneralController::searchLawyerReviews($request,$user_name);
        $response = generateResponse($lawyer_reviews,true,"Lawyer Reviews Fetched Successfully",null,'collection');
        return response()->json($response);
    }
    public function getLawFirmReviews(Request $request,$user_name){
        $law_firm_reviews = WebAPIGeneralController::searchLawFirmReviews($request,$user_name);
        $response = generateResponse($law_firm_reviews,true,"LawFirm Reviews Fetched Successfully",null,'collection');
        return response()->json($response);
    }

    public function getLawFirms(Request $request){
        // $request->validate(['country_id' => 'exists:countries,id']);
        $law_firms = WebAPIGeneralController::searchLawFirms($request);
        $response = generateResponse($law_firms,true,"LawFirms Fetched Successfully",null,'collection');
        return response()->json($response);
    }

    public function getLawFirmCategories(Request $request){
        $law_firm_categories = WebAPIGeneralController::getLawFirmCategories($request);
        $response = generateResponse($law_firm_categories,true,"LawFirm Categories Fetched Successfully",null,'collection');
        return response()->json($response);
    }

    public function getBlogCategories(Request $request){
        $blog_categories = WebAPIGeneralController::getBlogCategories($request);
        $response = generateResponse($blog_categories,true,"Blog Categories Fetched Successfully",null,'collection');
        return response()->json($response);
    }

    public function getTags(Request $request){
        $tags = WebAPIGeneralController::getTags($request);
        $response = generateResponse($tags,true,"Tags Fetched Successfully",null,'collection');
        return response()->json($response);
    }

    public function getServiceCategories(Request $request){
        $service_categories = WebAPIGeneralController::getServiceCategories($request);
        $response = generateResponse($service_categories,true,"ServiceCategories Fetched Successfully",null,'collection');
        return response()->json($response);
    }

    public function getArchiveCategories(Request $request){
        $archive_categories = WebAPIGeneralController::getArchiveCategories($request);
        $response = generateResponse($archive_categories,true,"Blog Categories Fetched Successfully",null,'collection');
        return response()->json($response);
    }

    public function getLawyerCategories(Request $request){
        $lawyer_categories = WebAPIGeneralController::getLawyerCategories($request);
        $response = generateResponse($lawyer_categories,true,"Lawyer Categories Fetched Successfully",null,'collection');
        return response()->json($response);
    }
    public function getFeaturedLawyerCategories(Request $request){
        $featured_lawyer_categories = WebAPIGeneralController::getFeaturedLawyerCategories($request);
        $response = generateResponse($featured_lawyer_categories,true,"Lawyer Categories Fetched Successfully",null,'collection');
        return response()->json($response);
    }


    public function getCities(Request $request){
        $request->validate(['state_id' => 'exists:states,id']);
        $cities = WebAPIGeneralController::getCities($request);
        $response = generateResponse($cities,true,"Cities Fetched Successfully",null,'collection');
        return response()->json($response);
    }

    public function getFeaturedTags(Request $request){
        $featured_tags = WebAPIGeneralController::getFeaturedTags($request);
        $response = generateResponse($featured_tags,true,"Featured Tags Fetched Successfully",null,'collection');
        return response()->json($response);
    }

    public function getFeaturedLawyers(Request $request){
        $featured_lawyers = WebAPIGeneralController::getFeaturedLawyers($request);
        $response = generateResponse($featured_lawyers,true,"Featured Lawyers Fetched Successfully",null,'collection');
        return response()->json($response);
    }
    public function getTopRatedLawyers(Request $request){
        $top_rated_lawyers = WebAPIGeneralController::getTopRatedLawyers($request);
        $response = generateResponse($top_rated_lawyers,true,"Featured Lawyers Fetched Successfully",null,'collection');
        return response()->json($response);
    }

    public function getPremiumLawyers(Request $request)
    {
        $premium_lawyeres = WebAPIGeneralController::getPremiumLawyers($request);
        $response = generateResponse($premium_lawyeres,true,"Premium Lawyers Fetched Successfully",null,'collection');
        return response()->json($response);
    }
    public function getFeaturedEvents(Request $request){
        $featured_events = WebAPIGeneralController::getFeaturedEvents($request);
        $response = generateResponse($featured_events,true,"Featured Events Fetched Successfully",null,'collection');
        return response()->json($response);
    }
    public function getSpotlightLawyers(Request $request){
        $spotlight_lawyers = WebAPIGeneralController::getSpotlightLawyers($request);
        $response = generateResponse($spotlight_lawyers,true,"Spotlight Lawyers Fetched Successfully",null,'collection');
        return response()->json($response);
    }
    public function getFeaturedLawFirms(Request $request){
        $featured_law_firms = WebAPIGeneralController::getFeaturedLawFirms($request);
        $response = generateResponse($featured_law_firms,true,"Featured LawFirms Fetched Successfully",null,'collection');
        return response()->json($response);
    }
    public function getFaqs(Request $request){
        $faqs = WebAPIGeneralController::getFaqs($request);
        $response = generateResponse($faqs,true,"FAQS Fetched Successfully",null,'collection');
        return response()->json($response);
    }

    public function getTrendingCommunityPosts(Request $request){
        $communit_posts = WebAPIGeneralController::getTrendingCommunityPosts($request);
        $response = generateResponse($communit_posts,true,"Communit_posts Fetched Successfully",null,'collection');
        return response()->json($response);
    }

}
