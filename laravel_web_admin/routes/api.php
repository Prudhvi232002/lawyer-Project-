<?php

use App\Http\Controllers\API\AgoraController;
use App\Http\Controllers\API\Auth\APIAuthController;
use App\Http\Controllers\API\APIController;
use App\Http\Controllers\API\APIDetailController;
use App\Http\Controllers\API\Auth\APIAccountController;
use App\Http\Controllers\API\Auth\APIBroadcastAuthController;
use App\Http\Controllers\API\Customers\APIReviewsController;
use App\Http\Controllers\API\APIAppointmentsController;
use App\Http\Controllers\API\APIServicesController;
use App\Http\Controllers\API\Customers\CustomerBookedServicesController;
use App\Http\Controllers\API\Customers\CustomerChatMessagesController;
use App\Http\Controllers\API\Customers\CustomerServiceChatMessagesController;
//Lawyers
use App\Http\Controllers\API\Lawyers\APILawyerAppointmentScheduleController;
use App\Http\Controllers\API\Lawyers\APILawyerProfileController;
use App\Http\Controllers\API\Lawyers\LawyerCertificationsController;
use App\Http\Controllers\API\Lawyers\LawyerBroadcastsController;
use App\Http\Controllers\API\Lawyers\LawyerPodcastsController;
use App\Http\Controllers\API\Lawyers\LawyerEventsController;
use App\Http\Controllers\API\Lawyers\LawyerPostsController;
use App\Http\Controllers\API\Lawyers\LawyerArchivesController;
use App\Http\Controllers\API\Lawyers\LawyerExperiencesController;
use App\Http\Controllers\API\Lawyers\LawyerEducationsController;
use App\Http\Controllers\API\Lawyers\LawyerChatMessagesController;
//Lawyers
//LawFirms
use App\Http\Controllers\API\LawFirm\APILawFirmAppointmentScheduleController;
use App\Http\Controllers\API\LawFirm\APILawFirmProfileController;
use App\Http\Controllers\API\Lawyers\LawyerBookedServicesController;
use App\Http\Controllers\API\Lawyers\LawyerServiceChatMessagesController;
use App\Http\Controllers\API\Lawyers\LawyerServicesController;
use App\Http\Controllers\API\NotificationSettingsController;
use App\Http\Controllers\API\WalletController;
use App\Http\Controllers\ContactsController;
use App\Models\InAppNotification;
use App\Models\NotificationSetting;
//LawFirms
use App\PusherBeam\PusherBeamService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('auth')->name('auth.')->group(function () {
    Route::post('/login', [APIAuthController::class, 'submitLoginForm'])->name('submit.login');
    Route::post('/social_login', [APIAuthController::class, 'socialLogin'])->name('submit.social_login');
    Route::post('/register', [APIAuthController::class, 'submitRegisterForm'])->name('submit.register');
    Route::post('/forgot_password', [APIAuthController::class, 'submitForgotPasswordForm'])->name('password.forgot');
    Route::post('/reset_password', [APIAuthController::class, 'submitResetPasswordForm'])->name('password.reset');
    Route::get('/logout', [APIAuthController::class, 'logout'])->name('logout');
    Route::get('/user', [APIAuthController::class, 'getLoggedInUser'])->name('user');
    Route::get('/delete_account', [APIAuthController::class, 'deleteAccount'])->name('account.delete');
});

Route::get('in_app_notifications', [NotificationSettingsController::class, 'getInAppNotification']);
Route::post('is_seen_notification_status/{id}',[NotificationSettingsController::class,'updateIsSeenNotificationStatus']);

Route::prefix('lawyers')->name('lawyers.')->group(function () {
    Route::post('update_general_info', [APIAccountController::class, 'updateLawyerGeneralInformation'])->name('update_general_info');
    Route::post('update_settings', [APIAccountController::class, 'updateLawyerSettings'])->name('update_settings');
    Route::post('become_lawyer', [APIAccountController::class, 'becomeLawyer'])->name('lawyers.become_lawyer');
    //Lawyer Appointments Apis
    Route::post('save_appointment_schedules', [APILawyerAppointmentScheduleController::class, 'saveAppointmentSchedule'])->name('save_appointment_schedules');
    Route::post('add_new_appointment_schedules', [APILawyerAppointmentScheduleController::class, 'addNewAppointmentSchedule'])->name('add_new_appointment_schedules');
    Route::post('delete_appointment_slots', [APILawyerAppointmentScheduleController::class, 'deleteAppointmentScheduleSlots'])->name('delete_appointment_slots');
    Route::get('/api_appointment_schedules', [APILawyerAppointmentScheduleController::class, 'getAppointmentSchedules'])->name('getApiAppointmentSchedules');
    Route::get('/get_appointment_commission', [APILawyerAppointmentScheduleController::class, 'getAppointmentCommission'])->name('getApiAppointmentCommission');



    Route::get('/get_filter_appointment_logs', [APILawyerAppointmentScheduleController::class, 'getFilteredAppointmentlogs'])->name('getApiFilsterAppointmentLogs');
    Route::get('/get_filter_appointment_log_detail/{book_appointment}', [APILawyerAppointmentScheduleController::class, 'showAppointmentLogDetail'])->name('showAppointmentLogDetail');
    Route::get('profile/{user_name}/book_appointment', [APILawyerProfileController::class, 'bookAppointment'])->name('book_appointment');
    Route::get('profile/{user_name}/appointment_types', [APILawyerProfileController::class, 'getLwyerAppointmentTypes'])->name('book_appointment_types');
    Route::post('update_appointment_status/{book_appointment}', [APILawyerAppointmentScheduleController::class, 'updateAppointmentStatus'])->name('update_appointment_status');
    Route::get('/api_get_chat_messages/{appointment}', [LawyerChatMessagesController::class, 'getChatMessages'])->name('getApiChatMessages');
    Route::post('/api_send_chat_message', [LawyerChatMessagesController::class, 'sendChatMessage'])->name('postApiSendMessage');

    Route::get('/get_filter_booked_services', [LawyerBookedServicesController::class, 'getFilteredBookedServices'])->name('getApiFilterBookedServices');
    Route::get('/get_filter_booked_service_detail/{booked_service}', [LawyerBookedServicesController::class, 'showBookedServiceDetail'])->name('showBookedServiceDetail');
    Route::post('update_booked_service_status/{booked_service}', [LawyerBookedServicesController::class, 'updateBookedServiceStatus'])->name('update_service_status');
    Route::get('/api_get_service_chat_messages/{booked_service}', [LawyerServiceChatMessagesController::class, 'getChatMessages'])->name('getApiServiceChatMessages');
    Route::post('/api_service_send_chat_message', [LawyerServiceChatMessagesController::class, 'sendChatMessage'])->name('postApiSendServiceMessage');

    //Lawyer Call Apis
    Route::get('/api_generate_agora_token', [AgoraController::class, 'generateAgoraToken'])->name('getAgoraToken');
    Route::post('/api_make_agora_call', [AgoraController::class, 'makeAgoraCall'])->name('postApiMakeAgoraCall');
    //Lawyer Call Apis
    //Lawyer Chat Apis
    //Lawyer Chat Apis
    //Lawyer Appointments Apis

    //Lawyer CRUDS
    Route::apiCrudRoutes('lawyer_certifications', LawyerCertificationsController::class);
    Route::apiCrudRoutes('lawyer_broadcasts', LawyerBroadcastsController::class);
    Route::apiCrudRoutes('lawyer_podcasts', LawyerPodcastsController::class);
    Route::apiCrudRoutes('lawyer_services', LawyerServicesController::class);
    Route::apiCrudRoutes('lawyer_events', LawyerEventsController::class);
    Route::apiCrudRoutes('lawyer_posts', LawyerPostsController::class);
    Route::apiCrudRoutes('lawyer_archives', LawyerArchivesController::class);
    Route::apiCrudRoutes('lawyer_experiences', LawyerExperiencesController::class);
    Route::apiCrudRoutes('lawyer_educations', LawyerEducationsController::class);


    //Lawyer CRUDS

    Route::post('/api_send_notification', function (Request $request) {
        $request->validate(
            [
                'title' => 'required|string',
                'body' => 'required|string',
                'deep_link' => 'required|string',
                'reciever_id' => 'required|exists:customers,id',
                'payload' => 'required',
                'payload.appointment' => "required",
                'payload.channel_name' => "required",
                'payload.token' => "required"
            ]
        );
        try {
            $title = $request->title;
            $body = $request->body;
            $deep_link = env('APP_URL') . $request->deep_link;
            $pusher = new PusherBeamService;
            $users = (string)$request->reciever_id;
            $pusher->sendNotificationToUsers($users, $title, $body, $deep_link, $request->payload);
            $response = generateResponse(null, true, "Notification Sent Successfully", null, 'collection');
            return response()->json($response, 200);
        } catch (\Exception $e) {
            $response = generateResponse(null, false, $e->getMessage(), null, 'collection');
            return response()->json($response, 200);
        }
    })->name('getApiSendPushNotification');
});
Route::prefix('law_firms')->name('law_firms.')->group(function () {
    Route::post('update_general_info', [APIAccountController::class, 'updateLawFirmGeneralInformation'])->name('update_general_info');
    Route::post('update_settings', [APIAccountController::class, 'updateLawFirmSettings'])->name('update_settings');
    Route::post('become_law_firm', [APIAccountController::class, 'becomeLawFirm'])->name('law_firms.become_law_firm');
    //Lawyer Appointments Apis
    Route::post('save_appointment_schedules', [APILawFirmAppointmentScheduleController::class, 'saveAppointmentSchedule'])->name('save_appointment_schedules');
    Route::post('add_new_appointment_schedules', [APILawFirmAppointmentScheduleController::class, 'addNewAppointmentSchedule'])->name('add_new_appointment_schedules');
    Route::post('delete_appointment_slots', [APILawFirmAppointmentScheduleController::class, 'deleteAppointmentScheduleSlots'])->name('delete_appointment_slots');
    Route::get('/api_appointment_schedules', [APILawFirmAppointmentScheduleController::class, 'getAppointmentSchedules'])->name('getApiAppointmentSchedules');
    Route::get('profile/{user_name}/book_appointment', [APILawFirmProfileController::class, 'bookAppointment'])->name('book_appointment');
    //Lawyer Appointments Apis
});
Route::prefix('customers')->name('customers.')->group(function () {
    Route::post('update_general_info', [APIAccountController::class, 'updateCustomerGeneralInformation'])->name('update_general_info');
    Route::post('become_customer', [APIAccountController::class, 'becomeUser'])->name('become_user');
    Route::post('add_lawyer_review', [APIReviewsController::class, 'addLawyerReview'])->name('add_lawyer_review');
    Route::post('add_law_firm_review', [APIReviewsController::class, 'addLawFirmReview'])->name('add_law_firm_review');
    Route::post('book_appointment', [APIAppointmentsController::class, 'bookAppointment'])->name('book_appointment');
    Route::get('/get_filter_appointment_logs', [APIAppointmentsController::class, 'getFilteredAppointmentlogs'])->name('getApiFilsterAppointmentLogs');
    Route::get('/get_filter_appointment_log_detail/{book_appointment}', [APIAppointmentsController::class, 'showAppointmentLogDetail'])->name('showAppointmentLogDetail');

    Route::post('book_service', [CustomerBookedServicesController::class, 'bookService'])->name('book_service');
    Route::get('/get_filter_service_logs', [CustomerBookedServicesController::class, 'getFilteredServiceLogs'])->name('getApiFilterServiceLogs');
    Route::get('/get_filter_service_log_detail/{booked_service}', [CustomerBookedServicesController::class, 'showServiceLogDetail'])->name('showServiceLogDetail');
    // Route::get('/api_generate_agora_token', [AgoraController::class, 'generateAgoraToken'])->name('getAgoraToken');
    // Route::post('/api_make_agora_call', [AgoraController::class, 'makeAgoraCall'])->name('postApiMakeAgoraCall');
    //Customer Call Apis
    //Customer Chat Apis
    Route::get('/api_get_chat_messages/{appointment}', [CustomerChatMessagesController::class, 'getChatMessages'])->name('getApiChatMessages');
    Route::post('/api_send_chat_message', [CustomerChatMessagesController::class, 'sendChatMessage'])->name('postApiSendMessage');
    Route::get('/api_get_service_chat_messages/{booked_service}', [CustomerServiceChatMessagesController::class, 'getChatMessages'])->name('getApiServiceChatMessages');
    Route::post('/api_send_service_chat_message', [CustomerServiceChatMessagesController::class, 'sendChatMessage'])->name('postApiSendServiceMessage');
    //Customer Chat Apis


});
Route::post('/broadcasting/auth', [APIBroadcastAuthController::class, 'auth']);


Route::middleware(['api', 'api_setting'])->group(function () {


    Route::get('settings', [APIController::class, 'getAllSettings'])->name('getAllSettings');
    Route::get('themes', [APIController::class, 'getAllThemes'])->name('getAllThemes');
    Route::get('gateways', [APIController::class, 'getAllGateways'])->name('getAllGateways');

    Route::get('countries', [APIController::class, 'getCountries'])->name('getCountries');
    Route::get('appointment_types', [APIController::class, 'getAppointmentTypes'])->name('getAppointmentTypes');
    Route::get('lawyer_categories', [APIController::class, 'getLawyerCategories'])->name('getLawyerCategories');
    Route::get('lawyer_main_categories_with_childrens', [APIController::class, 'getLawyerMainCategoriesWithChildrens'])->name('getLawyerMainCategoriesWithChildrens');
    Route::get('law_firm_categories', [APIController::class, 'getLawFirmCategories'])->name('getLawFirmCategories');
    Route::get('featured_lawyers', [APIController::class, 'getFeaturedLawyers'])->name('getFeaturedLawyers');
    Route::get('featured_law_firms', [APIController::class, 'getFeaturedLawFirms'])->name('getFeaturedLawFirms');
    Route::get('featured_events', [APIController::class, 'getFeaturedEvents'])->name('getFeaturedEvents');
    Route::get('featured_tags', [APIController::class, 'getFeaturedTags'])->name('getFeaturedTags');
    Route::get('top_rated_lawyers', [APIController::class, 'getTopRatedLawyers'])->name('getTopRatedLawyers');
    Route::get('app_carousels', [APIController::class, 'getAppCarousels'])->name('getAppCarousels');

    Route::post('filter_lawyers', [APIController::class, 'getLawyers'])->name('getLawyers');
    Route::post('filter_law_firms', [APIController::class, 'getLawFirms'])->name('getLawFirms');
    Route::post('filter_lawyer_reviews/{user_name}', [APIController::class, 'getLawyerReviews'])->name('getLawyerReviews');
    Route::post('filter_lawyer_podcasts/{user_name}', [APIController::class, 'getLawyerPodcasts'])->name('getLawyerPodcasts');
    Route::post('filter_lawyer_broadcasts/{user_name}', [APIController::class, 'getLawyerBroadcasts'])->name('getLawyerBroadcasts');
    Route::post('filter_law_firm_reviews/{user_name}', [APIController::class, 'getLawFirmReviews'])->name('getLawFirmReviews');

    Route::get('testimonials', [APIController::class, 'getTestimonials'])->name('getTestimonials');
    Route::get('get_all_languages', [APIController::class, 'getAllLanguages'])->name('getAllLanguages');

    Route::post('filter_events', [APIController::class, 'getEvents'])->name('getEvents');
    Route::get('blog_categories', [APIController::class, 'getBlogCategories'])->name('getBlogCategories');
    Route::get('tags', [APIController::class, 'getTags'])->name('getTags');
    Route::get('archive_categories', [APIController::class, 'getArchiveCategories'])->name('getArchiveCategories');
    Route::get('service_categories', [APIController::class, 'getServiceCategories'])->name('getServiceCategories');
    Route::post('filter_services', [APIController::class, 'getServices'])->name('getServices');

    Route::post('filter_posts', [APIController::class, 'getPosts'])->name('getPosts');
    Route::post('filter_archives', [APIController::class, 'getArchives'])->name('getArchives');
    Route::post('filter_broadcasts', [APIController::class, 'getBroadcasts'])->name('getBroadcasts');
    Route::post('filter_podcasts', [APIController::class, 'getPodcasts'])->name('getPodcasts');


    Route::get('company_page/{slug}', [APIController::class, 'getCompanyPage'])->name('getCompanyPage');

    Route::get('lawyers/{user_name}', [APIDetailController::class, 'lawyerDetail'])->name('lawyers.detail');
    Route::get('law_firms/{user_name}', [APIDetailController::class, 'lawFIrmDetail'])->name('law_fIrms.detail');

    Route::get('blogs/{slug}', [APIDetailController::class, 'blogDetail'])->name('blogs.detail');
    Route::get('archives/{slug}', [APIDetailController::class, 'archiveDetail'])->name('archives.detail');
    Route::get('podcasts/{slug}', [APIDetailController::class, 'podcastDetail'])->name('podcasts.detail');
    Route::get('services/{slug}', [APIDetailController::class, 'serviceDetail'])->name('services.detail');
    Route::get('broadcasts/{slug}', [APIDetailController::class, 'broadcastDetail'])->name('broadcasts.detail');
    Route::get('events/{slug}', [APIDetailController::class, 'eventDetail'])->name('events.detail');
    Route::get('tags/{slug}', [APIDetailController::class, 'tagDetail'])->name('tags.detail');
    Route::post('contact', [ContactsController::class, 'contact_api'])->name('contact_api.store');

    Route::get('get_current_balance', [WalletController::class, 'getCurrentBalance'])->name('get_current_balance');
    Route::get('get_wallet_transactions', [WalletController::class, 'getWalletTransactions'])->name('get_wallet_transactions');
    Route::get('get_wallet_withdrawls', [WalletController::class, 'getWalletWithdrawls'])->name('get_wallet_withdrawls');
    Route::post('withdraw_amount', [WalletController::class, 'withdrawAmount'])->name('withdraw_amount');
    Route::post('add-to-wallet', [WalletController::class, 'AddAmountToWallet'])->name('wallet.addAmount');
});
Route::get('pusher/beams-auth', [PusherBeamService::class, 'generateToken']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
