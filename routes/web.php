<?php

use App\Http\Controllers\AgoraController;
use App\Http\Controllers\API\APIController;
use App\Http\Controllers\Auth\AccountController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\SocialAuthController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\WebAPIController;
use App\Http\Controllers\LawFirms\LawFirmArchivesController;
use App\Http\Controllers\LawFirms\LawFirmBroadcastsController;
use App\Http\Controllers\LawFirms\LawFirmEventsController;
use App\Http\Controllers\LawFirms\LawFirmPodcastsController;
use App\Http\Controllers\LawFirms\LawFirmPostsController;
use App\Http\Controllers\LawFirms\LawFirmProfileController;
use App\Http\Controllers\CompanyPagesController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\Customers\ReviewsController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\Lawyers\LawyerArchivesController;
use App\Http\Controllers\Lawyers\LawyerBroadcastsController;
use App\Http\Controllers\Lawyers\LawyerEventsController;
use App\Http\Controllers\Lawyers\LawyerPodcastsController;
use App\Http\Controllers\Lawyers\LawyerPostsController;
use App\Http\Controllers\Lawyers\LawyerProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\PricingPlansController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use App\PusherBeam\PusherBeamService;
use App\Http\Controllers\Lawyers\AppointmentScheduleController;
use App\Http\Controllers\Lawyers\BookAppointmentController as LawyersBookAppointmentController;
use App\Http\Controllers\Customers\BookAppointmentController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AppointmentRatingsController;
use App\Http\Controllers\LawFirms\AppointmentScheduleController as LawFirmsAppointmentScheduleController;
use App\Http\Controllers\LawFirms\BookAppointmentController as LawFirmsBookAppointmentController;
use App\Http\Controllers\ChatMessagesController;
use App\Http\Controllers\Customers\BookedServicesController;
use App\Http\Controllers\LawFirms\BookedServicesController as LawFirmsBookedServicesController;
use App\Http\Controllers\LawFirms\LawFirmCertificationsController;
use App\Http\Controllers\LawFirms\LawFirmLawyersController;
use App\Http\Controllers\LawFirms\LawFirmServicesController;
use App\Http\Controllers\Lawyers\BookedServicesController as LawyersBookedServicesController;
use App\Http\Controllers\Lawyers\CommunityPostsController;
use App\Http\Controllers\Lawyers\LawyerCertificationsController;
use App\Http\Controllers\Lawyers\LawyerExperiencesController;
use App\Http\Controllers\Lawyers\LawyerEducationsController;
use App\Http\Controllers\Lawyers\LawyerServicesController;
use App\Http\Middleware\API\Lawyer;
use App\Models\Archive;
use App\Models\Broadcast;
use App\Models\Event;
use App\Models\LawFirm;
use App\Models\Lawyer as ModelsLawyer;
use App\Models\Podcast;
use App\Models\Post;
use Illuminate\Support\Str;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\NotificationSettingsController;
use App\Http\Controllers\SuperAdmin\BankAccountsController;
use App\Http\Controllers\SuperAdmin\BookedAppointmentsController;
use App\Http\Controllers\WalletController;
use App\Models\BookAppointment;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BotManController;
use App\Http\Controllers\PaymentMethods\StripePaymentsController;
use App\Models\BankAccount;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('gateways', [PaymentController::class,'gateways']);
Route::get('add_fund_request', [PaymentController::class,'addFundRequest'])->name('user.addFund');

// Route::post('fund_bank_transfer',[BankAccountsController::class,'fundBankTransfer'])->name('fund_bank_transfer');


Route::get('add_fund_confirm/{transaction}', [PaymentController::class,'depositConfirm'])->name('user.addFund.confirm');
Route::match(['get', 'post'], 'success', [PaymentController::class,'success'])->name('success');
Route::match(['get', 'post'], 'failed', [PaymentController::class,'failed'])->name('failed');
Route::match(['get', 'post'], 'payment/{code}/{trx?}/{type?}', [PaymentController::class,'gatewayIpn'])->name('ipn')->withoutMiddleware([App\Http\Middleware\VerifyCsrfToken::class]);

Route::get('/email/verify', [VerificationController::class, 'showEmailVerificationPage'])->middleware('auth')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verifyEmail'])->middleware(['auth', 'signed'])->name('verification.verify');
Route::post('/email/verification-notification', [VerificationController::class, 'resendVerificationEmail'])->middleware(['auth', 'throttle:6,1'])->name('verification.send');


Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('/forgot_password', [AuthController::class, 'showForgotPasswordForm'])->name('forgot_password');
Route::get('/reset_password', [AuthController::class, 'showResetPasswordForm'])->name('reset_password');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/login', [AuthController::class, 'submitLoginForm'])->name('submit.login');
Route::post('/register', [AuthController::class, 'submitRegisterForm'])->name('submit.register');
Route::post('/forgot_password', [AuthController::class, 'submitForgotPasswordForm'])->name('password.forgot');
Route::post('/reset_password', [AuthController::class, 'submitResetPasswordForm'])->name('password.reset');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/social_auth/{provider}', [SocialAuthController::class, 'redirectToProvider'])->name('social_redirect');
Route::get('/social_auth/{provider}/callback', [SocialAuthController::class, 'providerCallback'])->name('social_callback');

Route::get('language/{language}', function (Request $request, $language) {
    session()->put('locale', $language);
    request()->session()->flash('alert', [
        'type' => 'info',
        'message' => 'Language Switched Successfully',
    ]);
    return redirect()->back();
})->name('language');

Route::prefix('lawyers')->name('lawyers.')->group(function () {
    Route::post('update_general_info', [AccountController::class, 'updateLawyerGeneralInformation'])->name('update_general_info');
    Route::post('update_settings', [AccountController::class, 'updateLawyerSettings'])->name('update_settings');

    Route::apiCrudRoutes('lawyer_broadcasts', LawyerBroadcastsController::class);
    Route::apiCrudRoutes('lawyer_podcasts', LawyerPodcastsController::class);
    Route::apiCrudRoutes('lawyer_services', LawyerServicesController::class);
    Route::apiCrudRoutes('lawyer_events', LawyerEventsController::class);
    Route::apiCrudRoutes('lawyer_archives', LawyerArchivesController::class);
    Route::apiCrudRoutes('lawyer_posts', LawyerPostsController::class);
    Route::apiCrudRoutes('lawyer_certifications', LawyerCertificationsController::class);
    Route::apiCrudRoutes('lawyer_experiences', LawyerExperiencesController::class);
    Route::apiCrudRoutes('lawyer_educations', LawyerEducationsController::class);

    Route::apiCrudRoutes('community_posts', CommunityPostsController::class);
});
Route::prefix('law_firms')->name('law_firms.')->group(function () {
    Route::post('update_general_info', [AccountController::class, 'updateLawFirmGeneralInformation'])->name('update_general_info');
    Route::post('update_settings', [AccountController::class, 'updateLawFirmSettings'])->name('update_settings');

    Route::apiCrudRoutes('law_firm_broadcasts', LawFirmBroadcastsController::class);
    Route::apiCrudRoutes('law_firm_podcasts', LawFirmPodcastsController::class);
    Route::apiCrudRoutes('law_firm_services', LawFirmServicesController::class);

    Route::apiCrudRoutes('law_firm_events', LawFirmEventsController::class);
    Route::apiCrudRoutes('law_firm_archives', LawFirmArchivesController::class);
    Route::apiCrudRoutes('law_firm_posts', LawFirmPostsController::class);
    Route::apiCrudRoutes('law_firm_certifications', LawFirmCertificationsController::class);
    Route::apiCrudRoutes('law_firm_lawyers', LawFirmLawyersController::class);
});
Route::prefix('customers')->name('customers.')->group(function () {
    Route::post('add_lawyer_review', [ReviewsController::class, 'addLawyerReview'])->name('add_lawyer_review');
    Route::post('add_law_firm_review', [ReviewsController::class, 'addLawFirmReview'])->name('add_law_firm_review');
});

Route::prefix('customers')->name('customers.')->group(function () {
    Route::post('update_general_info', [AccountController::class, 'updateCustomerGeneralInformation'])->name('update_general_info');
    Route::get('appointment_bank_transfers/{appointment_id}', [BookAppointmentController::class, 'getBankTransfers'])->name('appointment_bank_transfers');
    Route::post('book_appointment', [BookAppointmentController::class, 'bookAppointment'])->name('book_appointment');
    Route::post('book_service', [BookedServicesController::class, 'bookService'])->name('book_service');
    Route::get('service_bank_transfers/{service_id}', [BookedServicesController::class, 'getBankTransfers'])->name('service_bank_transfers');
    Route::post('fund_bank_transfer',[BookAppointmentController::class,'fundBankTransfer'])->name('fund_bank_transfer');

    Route::get('appointment_stripe_transfers/{appointment_id}', [StripePaymentsController::class, 'getStripeAccount'])->name('appointment_stripe_transfers');
    Route::get('service_stripe_transfers/{service_id}', [StripePaymentsController::class, 'getServiceStripeAccount'])->name('service_stripe_transfers');
    Route::get('wallet_stripe_transfers', [StripePaymentsController::class, 'getStripeAccountForWallet'])->name('appointment_stripe_transfers_for_wallet');

});
Route::get('book_service/{service}', [BookedServicesController::class, 'showBookServicePage'])->name('book_service_display')->middleware(['auth','customer']);
Route::prefix('lawyer')->name('lawyer.')->group(function () {
    Route::get('profile', [LawyerProfileController::class, 'myProfile'])->name('my_profile');
    Route::get('profile/{user_name}', [LawyerProfileController::class, 'profile'])->name('profile');
    Route::get('reviews/{user_name}', [LawyerProfileController::class, 'reviews'])->name('reviews');
    Route::post('save_appointment_schedules', [AppointmentScheduleController::class, 'saveAppointmentSchedule'])->name('save_appointment_schedules');
    Route::post('add_new_appointment_schedules', [AppointmentScheduleController::class, 'addNewAppointmentSchedule'])->name('add_new_appointment_schedules');
    Route::post('delete_appointment_slots', [AppointmentScheduleController::class, 'deleteAppointmentScheduleSlots'])->name('delete_appointment_slots');
    Route::get('/api_appointment_schedules', [AppointmentScheduleController::class, 'getAppointmentSchedules'])->name('getApiAppointmentSchedules');
    Route::get('/get_appointment_commission', [AppointmentScheduleController::class, 'getAppointmentCommission'])->name('getApiAppointmentCommission');
    Route::get('profile/{user_name}/book_appointment', [LawyerProfileController::class, 'bookAppointment'])->name('book_appointment')->middleware(['auth','customer']);

});
Route::prefix('law_firm')->name('law_firm.')->group(function () {
    Route::get('profile', [LawFirmProfileController::class, 'myProfile'])->name('my_profile');
    Route::get('profile/{user_name}', [LawFirmProfileController::class, 'profile'])->name('profile');
    Route::get('reviews/{user_name}', [LawFirmProfileController::class, 'reviews'])->name('reviews');
    Route::post('save_appointment_schedules', [LawFirmsAppointmentScheduleController::class, 'saveAppointmentSchedule'])->name('save_appointment_schedules');
    Route::post('add_new_appointment_schedules', [LawFirmsAppointmentScheduleController::class, 'addNewAppointmentSchedule'])->name('add_new_appointment_schedules');
    Route::post('delete_appointment_slots', [LawFirmsAppointmentScheduleController::class, 'deleteAppointmentScheduleSlots'])->name('delete_appointment_slots');
    Route::get('/api_appointment_schedules', [LawFirmsAppointmentScheduleController::class, 'getAppointmentSchedules'])->name('getApiAppointmentSchedules');
    Route::get('/get_appointment_commission', [LawFirmsAppointmentScheduleController::class, 'getAppointmentCommission'])->name('getApiAppointmentCommission');

    Route::get('profile/{user_name}/book_appointment', [LawFirmProfileController::class, 'bookAppointment'])->name('book_appointment')->middleware(['auth','customer']);
});

Route::post('add_appointment_rating', [AppointmentRatingsController::class, 'addAppointmentRating'])->name('add_appointment_rating');
Route::get('/account', [AccountController::class, 'showAccountPage'])->name('account');
Route::post('/account_become_lawyer', [AccountController::class, 'becomeLawyer'])->name('account.become_lawyer');
Route::post('/account_become_user', [AccountController::class, 'becomeUser'])->name('account.become_user');
Route::post('/account_become_law_firm', [AccountController::class, 'becomeLawFirm'])->name('account.become_law_firm');
Route::post('/account_switch_role/{role}', [AccountController::class, 'switchRole'])->name('account.switch_role');
Route::get('/account_states', [AccountController::class, 'getStates'])->name('account.getStates');
Route::get('/account_cities', [AccountController::class, 'getCities'])->name('account.getCities');

Route::get('/api_countries', [WebAPIController::class, 'getCountries'])->name('getApiCountries');
Route::get('/api_lawyer_categories', [WebAPIController::class, 'getLawyerCategories'])->name('getApiLawyerCategories');
Route::get('/api_featured_lawyer_categories', [WebAPIController::class, 'getFeaturedLawyerCategories'])->name('getApiFeaturedLawyerCategories');
Route::get('/api_lawyer_main_categories', [APIController::class, 'getLawyerMainCategoriesWithChildrens'])->name('getApiLawyerMainCategories');

Route::get('/api_law_firm_categories', [WebAPIController::class, 'getLawFirmCategories'])->name('getApiLawFirmCategories');
Route::get('/api_featured_lawyers', [WebAPIController::class, 'getFeaturedLawyers'])->name('getApiFeaturedLawyers');
Route::get('/api_top_rated_lawyers', [WebAPIController::class, 'getTopRatedLawyers'])->name('getApiTopRatedLawyers');
Route::get('/api_premium_lawyers', [WebAPIController::class, 'getPremiumLawyers'])->name('getApiPremiumLawyers');

Route::get('/api_featured_law_firms', [WebAPIController::class, 'getFeaturedLawFirms'])->name('getApiFeaturedLawFirms');
Route::get('/api_featured_events', [WebAPIController::class, 'getFeaturedEvents'])->name('getApiFeaturedEvents');
Route::get('/api_featured_tags', [WebAPIController::class, 'getFeaturedTags'])->name('getApiFeaturedTags');
Route::post('/api_lawyers', [WebAPIController::class, 'getLawyers'])->name('getApiLawyers');
Route::post('/api_law_firms', [WebAPIController::class, 'getLawFirms'])->name('getApiLawFirms');
Route::post('/api_lawyer_reviews/{user_name}', [WebAPIController::class, 'getLawyerReviews'])->name('getApiLawyerReviews');
Route::post('/api_law_firm_reviews/{user_name}', [WebAPIController::class, 'getLawFirmReviews'])->name('getApiLawFirmReviews');

Route::get('/api_testimonials', [WebAPIController::class, 'getTestimonials'])->name('getApiTestimonials');

Route::post('/api_events', [WebAPIController::class, 'getEvents'])->name('getApiEvents');
Route::get('/api_blog_categories', [WebAPIController::class, 'getBlogCategories'])->name('getApiBlogCategories');
Route::get('/api_tags', [WebAPIController::class, 'getTags'])->name('getApiTags');
Route::get('/api_service_categories', [WebAPIController::class, 'getServiceCategories'])->name('getApiServiceCategories');
Route::get('/api_archive_categories', [WebAPIController::class, 'getArchiveCategories'])->name('getApiArchiveCategories');
Route::post('/api_posts', [WebAPIController::class, 'getPosts'])->name('getApiPosts');
Route::post('/api_archives', [WebAPIController::class, 'getArchives'])->name('getApiArchives');
Route::post('/api_broadcasts', [WebAPIController::class, 'getBroadcasts'])->name('getApiBroadcasts');
Route::post('/api_podcasts', [WebAPIController::class, 'getPodcasts'])->name('getApiPodcasts');
Route::post('/api_services', [WebAPIController::class, 'getServices'])->name('getApiServices');
Route::get('/api_faqs', [WebAPIController::class, 'getFaqs'])->name('getApiFaqs');
Route::get('/api_trending_community_posts', [WebAPIController::class, 'getTrendingCommunityPosts'])->name('getApiTrendingCommunityPosts');


Route::get('/', [HomeController::class, 'home'])->name('home');
    Route::get('/pricing/{type}', [PricingPlansController::class, 'index'])->name('pricing');
    Route::get('/pricing/{type}/{slug}', [PricingPlansController::class, 'show'])->name('pricing.show');
    Route::post('/subscription/{type}/{slug}', [PricingPlansController::class, 'subscription'])->name('pricing.subscription');


Route::get('lawyers', [ListingController::class, 'lawyerListing'])->name('lawyers.listing');
Route::post('lawyers', [ListingController::class, 'lawyerListing'])->name('lawyers.listing');
Route::get('law_firms', [ListingController::class, 'law_firmListing'])->name('law_firms.listing');
Route::get('events', [ListingController::class, 'eventListing'])->name('events.listing');
Route::get('blogs', [ListingController::class, 'blogListing'])->name('blogs.listing');
Route::get('courses', [ListingController::class, 'archiveListing'])->name('archives.listing');
Route::get('podcasts', [ListingController::class, 'podcastListing'])->name('podcasts.listing');
Route::get('services', [ListingController::class, 'serviceListing'])->name('services.listing');
Route::get('media', [ListingController::class, 'broadcastListing'])->name('broadcasts.listing');
Route::get('tags', [ListingController::class, 'tagListing'])->name('tags.listing');

Route::get('blogs/{slug}', [DetailController::class, 'blogDetail'])->name('blogs.detail');
Route::get('courses/{slug}', [DetailController::class, 'archiveDetail'])->name('archives.detail');
Route::get('podcasts/{slug}', [DetailController::class, 'podcastDetail'])->name('podcasts.detail');
Route::get('services/{slug}', [DetailController::class, 'serviceDetail'])->name('services.detail');
Route::get('media/{slug}', [DetailController::class, 'broadcastDetail'])->name('broadcasts.detail');
Route::get('events/{slug}', [DetailController::class, 'eventDetail'])->name('events.detail');
Route::get('tags/{slug}', [DetailController::class, 'tagDetail'])->name('tags.detail');

Route::get('community_posts/{slug}', [DetailController::class, 'communityPostDetail'])->name('community_post.detail');
Route::post('/community_post_like/{post}',[CommunityPostsController::class,'postLike'])->name('post.like');
Route::post('/community_post_comment/{post}',[CommunityPostsController::class,'postComment'])->name('post.comment');
Route::post('/community_post_comment_reply/{comment}',[CommunityPostsController::class,'commentReply'])->name('comment.reply');

Route::get('/appointment_log', [AppointmentController::class, 'showAppointmentLogPage'])->name('appointment_log');
Route::get('/appointment_log/detail/{id}', [BookAppointmentController::class, 'showAppointmentLogDetailPage'])->name('customer.appointment_log.detail');
Route::post('/api_get_filter_appointment_logs', [BookAppointmentController::class, 'getFilteredAppointmentlogs'])->name('getApiFilterAppointmentLogs');
Route::post('/api_lawyer_get_filter_appointment_logs', [LawyersBookAppointmentController::class, 'getLawyerFilteredAppointmentlogs'])->name('getApiLawyerFilterAppointmentLogs');
Route::get('/lawyer_appointment_log/detail/{id}', [LawyersBookAppointmentController::class, 'showLawyerAppointmentLogDetailPage'])->name('lawyer.appointment_log.detail');
Route::post('/update_appointment_status', [LawyersBookAppointmentController::class, 'updateAppointmentStatus'])->name('appointment_detail.updateStatus');
Route::post('/update_appointment_started', [LawyersBookAppointmentController::class, 'updateAppointmentStarted'])->name('appointment_detail.updateStarted');
Route::post('/api_law_firm_get_filter_appointment_logs', [LawFirmsBookAppointmentController::class, 'getLawFirmsFilteredAppointmentlogs'])->name('getApiLawFirmsFilterAppointmentLogs');
Route::get('/law_firm_appointment_log/detail/{id}', [LawFirmsBookAppointmentController::class, 'showLawFirmsAppointmentLogDetailPage'])->name('law_firm.appointment_log.detail');
Route::post('/update_appointment_status_law_firm', [LawFirmsBookAppointmentController::class, 'updateAppointmentStatus'])->name('law_firm.appointment_detail.updateStatus');
Route::post('/update_appointment_started_law_firm', [LawFirmsBookAppointmentController::class, 'updateAppointmentStarted'])->name('law_firm.appointment_detail.updateStarted');
Route::get('/api_get_appointment_slots', [APIController::class, 'getAppointmentScheduleSlots'])->name('getApiAppointmentScheduleSlots');
Route::get('/api_get_lawfirm_appointment_slots', [APIController::class, 'getLawFirmAppointmentScheduleSlots'])->name('getApiLawFirmAppointmentScheduleSlots');

Route::get('/service_log', [ServicesController::class, 'showServiceLogsPage'])->name('service_log');
Route::get('/service_log/detail/{id}', [BookedServicesController::class, 'showServiceLogDetailPage'])->name('customer.service_log.detail');
Route::post('/api_get_filter_service_logs', [BookedServicesController::class, 'getFilteredServiceLogs'])->name('getApiFilterServiceLogs');
Route::post('/api_lawyer_get_filter_service_logs', [LawyersBookedServicesController::class, 'getLawyerFilteredServiceLogs'])->name('getApiLawyerFilterServiceLogs');
Route::get('/lawyer_service_log/detail/{id}', [LawyersBookedServicesController::class, 'showLawyerServiceLogDetailPage'])->name('lawyer.service_log.detail');
Route::post('/update_service_status', [LawyersBookedServicesController::class, 'updateServiceStatus'])->name('service_detail.updateStatus');
Route::post('/update_service_started', [LawyersBookedServicesController::class, 'updateServiceStarted'])->name('service_detail.updateStarted');
Route::post('/api_law_firm_get_filter_service_logs', [LawFirmsBookedServicesController::class, 'getLawFirmsFilteredServiceLogs'])->name('getApiLawFirmsFilterServiceLogs');
Route::get('/law_firm_service_log/detail/{id}', [LawFirmsBookedServicesController::class, 'showLawFirmsServiceLogDetailPage'])->name('law_firm.service_log.detail');
Route::post('/update_service_status_law_firm', [LawFirmsBookedServicesController::class, 'updateServiceStatus'])->name('law_firm.service_detail.updateStatus');
Route::post('/update_service_started_law_firm', [LawFirmsBookedServicesController::class, 'updateServiceStarted'])->name('law_firm.service_detail.updateStarted');



Route::get('/api_get_chat_messages', [ChatMessagesController::class, 'getChatMessages'])->name('getApiChatMessages');
Route::post('/api_send_chat_message', [ChatMessagesController::class, 'sendChatMessage'])->name('postApiSendMessage');

Route::get('/api_generate_agora_token', [AgoraController::class, 'generateAgoraToken'])->name('getAgoraToken');
Route::post('/api_make_agora_call', [AgoraController::class, 'makeAgoraCall'])->name('postApiMakeAgoraCall');
Route::get('/wallet', [WalletController::class,'index'])->name('wallet');
Route::post('/add-to-wallet', [WalletController::class, 'AddAmountToWallet'])->name('wallet.addAmount');
Route::post('/withdraw-from-wallet', [WalletController::class, 'withdrawAmount'])->name('wallet.withdraw');

Route::get('/api_send_notification', function (Request $request) {
    $title = $request->title;
    $body = $request->body;
    $deep_link = env('APP_URL') . $request->deep_link;
    $pusher = new PusherBeamService;
    $users = (string)$request->reciever_id;
    $pusher->sendNotificationToUsers($users, $title, $body, $deep_link, $request->payload);
})->name('getApiSendPushNotification');


Route::get('/contact', function () {
    // dd('ok');
    return Inertia::render('Contact');
})->name('contact');
Route::post('contact', [ContactsController::class, 'contact'])->name('contact.store');

Route::get('/donation', function () {
    // dd('ok');
    return Inertia::render('Donation');
})->name('donation');

Route::get('/community', function () {
    return Inertia::render('CommunityPosts/Index');
})->name('community');


Route::get('/faqs', [CompanyPagesController::class, 'faqs'])->name('faqs');
Route::get('/pages/{slug}', [CompanyPagesController::class, 'companyPage'])->name('company_pages.display');
Route::match(['get', 'post'], '/botman', [BotManController::class, 'handle']);


Route::get('/add_fund_bank_account', function (Request $request) {
    // dd($request->all());
    $bank_accounts = BankAccount::active()->get();
    return Inertia::render('AddFundBankAccount', [
        'bank_accounts' => $bank_accounts,
        'fund_id' => $request->data['fund_id'],
        'amount' => $request->data['amount'],
    ]);
})->name('add_fund_bank_account');

Route::get('/forum', function () {
    // dd('ok');
    return Inertia::render('Forum');
})->name('forum');

Route::get('/shop', function () {
    // dd('ok');
    return Inertia::render('Shop');
})->name('shop');

Route::get('/appointment', function () {
    // dd('ok');
    return Inertia::render('Appointment');
})->name('appointment');

Route::get('/appointment-log', function () {
    // dd('ok');
    return Inertia::render('AppointmentLog');
})->name('appointment-log');

Route::get('/our-story', function () {
    return Inertia::render('OurStory');
})->name('our-story');

Route::get('/heal-yourself', function () {
    return Inertia::render('HealYourSelf');
})->name('heal-yourself');


Route::get('/categories', function () {
    // dd('ok');
    return Inertia::render('Categories/Listing');
})->name('categories');

Route::get('/quickby-services', function () {
    // dd('ok');
    return Inertia::render('QuickbyService');
})->name('quickby-services');



Route::post('add_money/stripe', [StripePaymentsController::class, 'stripeTransfer'])->name('addmoney.stripe');
Route::post('add_money/service_stripe', [StripePaymentsController::class, 'servicestripeTransfer'])->name('addmoney.service_stripe');
Route::post('add_money_wallet/stripe', [StripePaymentsController::class, 'stripeTransferWallet'])->name('wallet.addmoney.stripe');

Route::get('duplicate_data', function () {
    $complete_data = Post::where('law_firm_id', 3)->whereNull('lawyer_id')->get();
    $copy_data_ids = LawFirm::where('id', '!=', 3)->pluck('id')->toArray();
    // dd($complete_data);
    foreach ($copy_data_ids as $key_law => $law_firm_id) {
        foreach ($complete_data as $key => $data) {
            $inserted_data = [
                'law_firm_id' => $law_firm_id,
                'blog_category_id' => $data->blog_category_id,
                'name' => $data->getTranslations('name'),
                'description' => $data->getTranslations('description'),
                'is_active' => $data->is_active,
                'is_featured' => $data->is_featured,
                'image' => $data->image,
            ];
            $RESULT = Post::create(
                $inserted_data
            );
            $RESULT->slug = Str::slug($data['name'] . ' ' . $RESULT->id, '-');
            $RESULT->save();

        }
    }
    return 'updated';
});
