<?php

use App\Http\Controllers\SuperAdmin\AJAXController;
use App\Http\Controllers\SuperAdmin\ArchiveCategoriesController;
use App\Http\Controllers\SuperAdmin\Auth\ForgotPasswordController;
use App\Http\Controllers\SuperAdmin\Auth\LoginController;
use App\Http\Controllers\SuperAdmin\RolesController;
use App\Http\Controllers\SuperAdmin\UsersController;
use App\Http\Controllers\SuperAdmin\CustomersController;
use App\Http\Controllers\SuperAdmin\DashboardController;
use App\Http\Controllers\SuperAdmin\GeneralSettingsController;
use App\Http\Controllers\SuperAdmin\ProfileController;
use App\Http\Controllers\SuperAdmin\BlogCategoriesController;
use App\Http\Controllers\SuperAdmin\CitiesController;
use App\Http\Controllers\SuperAdmin\CompanyPagesController;
use App\Http\Controllers\SuperAdmin\CountriesController;
use App\Http\Controllers\SuperAdmin\FAQCategoriesController;
use App\Http\Controllers\SuperAdmin\EventsController;
use App\Http\Controllers\SuperAdmin\FAQSController;
use App\Http\Controllers\SuperAdmin\LanguagesController;
use App\Http\Controllers\SuperAdmin\StatesController;
use App\Http\Controllers\SuperAdmin\PricingPlansController;
use App\Http\Controllers\SuperAdmin\TagsController;
use App\Http\Controllers\SuperAdmin\TestimonialsController;
use App\Http\Controllers\SuperAdmin\PagesContentsController;
use App\Http\Controllers\SuperAdmin\ContactsController;
use App\Http\Controllers\SuperAdmin\PostsController;
use App\Http\Controllers\SuperAdmin\ArchivesController;
use App\Http\Controllers\SuperAdmin\PodcastsController;
use App\Http\Controllers\SuperAdmin\BroadcastsController;
use App\Http\Controllers\SuperAdmin\BroadcastCategoriesController;
use App\Http\Controllers\SuperAdmin\EventCategoriesController;
use App\Http\Controllers\SuperAdmin\PodcastCategoriesController;
use App\Http\Controllers\SuperAdmin\BookedAppointmentsController;
use App\Http\Controllers\SuperAdmin\CommissionSettingsController;
use App\Http\Controllers\SuperAdmin\CurruncyController;
use App\Http\Controllers\SuperAdmin\GatewaysController;
//LawFirm
use App\Http\Controllers\SuperAdmin\LawFirmCategoriesController;
use App\Http\Controllers\SuperAdmin\LawFirmMainCategoriesController;
use App\Http\Controllers\SuperAdmin\LawFirmsController;
use App\Http\Controllers\SuperAdmin\LawFirmPostsController;
use App\Http\Controllers\SuperAdmin\LawFirmEventsController;
use App\Http\Controllers\SuperAdmin\LawFirmCertificationsController;
use App\Http\Controllers\SuperAdmin\LawFirmBroadcastsController;
use App\Http\Controllers\SuperAdmin\LawFirmPodcastsController;
use App\Http\Controllers\SuperAdmin\LawFirmArchivesController;
//LawFirm
//Lawyer
use App\Http\Controllers\SuperAdmin\LawyerPostsController;
use App\Http\Controllers\SuperAdmin\LawyerEventsController;
use App\Http\Controllers\SuperAdmin\LawyerEducationsController;
use App\Http\Controllers\SuperAdmin\LawyerExperiencesController;
use App\Http\Controllers\SuperAdmin\LawyerCertificationsController;
use App\Http\Controllers\SuperAdmin\LawyerBroadcastsController;
use App\Http\Controllers\SuperAdmin\LawyerPodcastsController;
use App\Http\Controllers\SuperAdmin\LawyerArchivesController;
use App\Http\Controllers\SuperAdmin\LawyerCategoriesController;
use App\Http\Controllers\SuperAdmin\LawyerMainCategoriesController;
use App\Http\Controllers\SuperAdmin\LawyersController;
use App\Http\Controllers\NotificationSettingsController;
use App\Http\Controllers\SuperAdmin\AppCarouselsController;
use App\Http\Controllers\SuperAdmin\BankAccountsController;
use App\Http\Controllers\SuperAdmin\BankTransactionsController;
use App\Http\Controllers\SuperAdmin\PaymentMethodsController;
use App\Http\Controllers\SuperAdmin\VersionUpgradesController;
use App\Http\Controllers\SuperAdmin\ServiceCategoriesController;
use App\Http\Controllers\SuperAdmin\ServicesController;
use App\Http\Controllers\SuperAdmin\SystemInformationsController;
use App\Http\Controllers\SuperAdmin\ThemeSettingsController;
use App\Http\Controllers\SuperAdmin\WithdrawRequestsController;
use App\Models\AppCarousel;
use Illuminate\Support\Facades\Route;

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

Route::middleware('guest')->prefix('super_admin')->name('super_admin.')->group(function () {
    Route::post('login', [LoginController::class, 'login'])->name('submit_login');
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::get('reset_password', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset_password');
    Route::get('forgot_password', [ForgotPasswordController::class, 'showForgotPasswordForm'])->name('forgot_password');
    Route::post('submit_reset_password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('submit_reset_password');
    Route::post('submit_forgot_password', [ForgotPasswordController::class, 'submitForgotPasswordForm'])->name('submit_forgot_password');
});

Route::middleware(['auth', 'super_admin'])->prefix('super_admin')->name('super_admin.')->group(function () {
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('dashboard', [DashboardController::class, 'home'])->name('dashboard');
    Route::resource('users', UsersController::class);
    Route::crudRoutes('customers', CustomersController::class);
    Route::crudRoutes('lawyers', LawyersController::class);
    Route::get('lawyers/blogs/{lawyer}', [LawyersController::class, 'viewBlogs'])->name('lawyers.blog');
    Route::get('lawyers/events/{lawyer}', [LawyersController::class, 'viewEvents'])->name('lawyers.event');
    Route::put('lawyers/{lawyer}/approve', [LawyersController::class, 'approve'])->name('lawyers.approve');
    Route::put('lawyers-bulk/{type}', [LawyersController::class, 'bulkActionLawyers'])->name('lawyers.bulk');
    Route::crudRoutes('law_firms', LawFirmsController::class);
    Route::put('law_firms/{law_firm}/approve', [LawFirmsController::class, 'approve'])->name('law_firms.approve');
    Route::put('law_firms-bulk/{type}', [LawFirmsController::class, 'bulkActionLawFirms'])->name('law_firms.bulk');
    Route::crudRoutes('events', EventsController::class);
    Route::put('events/{event}/approve', [EventsController::class, 'approve'])->name('events.approve');

    Route::crudRoutes('tags', TagsController::class);
    Route::crudRoutes('testimonials', TestimonialsController::class);
    Route::crudRoutes('company_pages', CompanyPagesController::class);
    Route::crudRoutes('lawyer_categories', LawyerCategoriesController::class);
    Route::crudRoutes('lawyer_main_categories', LawyerMainCategoriesController::class);
    Route::crudRoutes('law_firm_categories', LawFirmCategoriesController::class);
    Route::crudRoutes('law_firm_main_categories', LawFirmMainCategoriesController::class);
    Route::crudRoutes('blog_categories', BlogCategoriesController::class);
    Route::crudRoutes('event_categories', EventCategoriesController::class);
    Route::crudRoutes('faq_categories', FAQCategoriesController::class);
    Route::crudRoutes('podcast_categories', PodcastCategoriesController::class);
    Route::crudRoutes('service_categories', ServiceCategoriesController::class);
    Route::crudRoutes('services', ServicesController::class);
    Route::put('services/{service}/approve', [ServicesController::class, 'approve'])->name('services.approve');
    Route::put('services-bulk/{type}', [ServicesController::class, 'bulkActionServices'])->name('services.bulk');

    Route::crudRoutes('broadcast_categories', BroadcastCategoriesController::class);
    Route::crudRoutes('faqs', FAQSController::class);
    Route::crudRoutes('posts', PostsController::class);
    Route::crudRoutes('archives', ArchivesController::class);
    Route::crudRoutes('booked_appointments', BookedAppointmentsController::class);
    Route::crudRoutes('podcasts', PodcastsController::class);
    Route::crudRoutes('broadcasts', BroadcastsController::class);


    Route::dependentCrudRoutes('lawyer_posts/{lawyer}', LawyerPostsController::class);
    Route::dependentCrudRoutes('lawyer_events/{lawyer}', LawyerEventsController::class);
    Route::dependentCrudRoutes('lawyer_educations/{lawyer}', LawyerEducationsController::class);
    Route::dependentCrudRoutes('lawyer_experiences/{lawyer}', LawyerExperiencesController::class);
    Route::dependentCrudRoutes('lawyer_certifications/{lawyer}', LawyerCertificationsController::class);
    Route::dependentCrudRoutes('lawyer_broadcasts/{lawyer}', LawyerBroadcastsController::class);
    Route::dependentCrudRoutes('lawyer_podcasts/{lawyer}', LawyerPodcastsController::class);
    Route::dependentCrudRoutes('lawyer_archives/{lawyer}', LawyerArchivesController::class);

    //Law firm
    Route::dependentCrudRoutes('law_firm_posts/{law_firm}', LawFirmPostsController::class);
    Route::dependentCrudRoutes('law_firm_events/{law_firm}', LawFirmEventsController::class);
    // Route::dependentCrudRoutes('law_firm_educations/{law_firm}', LawFirmEducationsController::class);
    // Route::dependentCrudRoutes('law_firm_experiences/{law_firm}', LawFirmExperiencesController::class);
    Route::dependentCrudRoutes('law_firm_certifications/{law_firm}', LawFirmCertificationsController::class);
    Route::dependentCrudRoutes('law_firm_broadcasts/{law_firm}', LawFirmBroadcastsController::class);
    Route::dependentCrudRoutes('law_firm_podcasts/{law_firm}', LawFirmPodcastsController::class);
    Route::dependentCrudRoutes('law_firm_archives/{law_firm}', LawFirmArchivesController::class);

    Route::prefix('lawyers')->name('lawyers.')->group(function () {
        Route::get('profile/{lawyer}', [LawyersController::class, 'profile'])->name('profile');
    });
    Route::prefix('law_firms')->name('law_firms.')->group(function () {
        Route::get('profile/{law_firm}', [LawFirmsController::class, 'profile'])->name('profile');
    });

    Route::crudRoutes('archive_categories', ArchiveCategoriesController::class);
    Route::crudRoutes('languages', LanguagesController::class);
    Route::get('download_sample', [LanguagesController::class, 'downloadSampleFile'])->name('download_sample.get');
    Route::crudRoutes('app_carousels', AppCarouselsController::class);
    Route::crudRoutes('countries', CountriesController::class);
    Route::crudRoutes('states', StatesController::class);
    Route::crudRoutes('cities', CitiesController::class);
    Route::get('/cities/listing',[CitiesController::class,'listCountries'])->name('cities.list');
    Route::get('cities_states', [AJAXController::class, 'getStatesByCountry'])->name('getStatesByCountry');
    Route::crudRoutes('pricing_plans', PricingPlansController::class);
    Route::post('pricing_plans_syn', [PricingPlansController::class, 'syncPlans'])->name('pricing_plans.sync');

    Route::crudRoutes('bank_accounts', BankAccountsController::class);
    Route::crudRoutes('bank_transactions', BankTransactionsController::class);
    Route::put('bank_transactions/{bank_transaction}/approve', [BankTransactionsController::class, 'approve'])->name('bank_transactions.approve');
    Route::put('bank_transactions-bulk/{type}', [BankTransactionsController::class, 'approveapprove'])->name('bank_transactions.bulk');



    Route::get('commission', [CommissionSettingsController::class, 'index'])->name('commission.index');
    Route::post('commission', [CommissionSettingsController::class, 'commissionUpdate'])->name('commission.update');

    // General Settings route
    Route::get('general_settings', [GeneralSettingsController::class, 'index'])->name('general_settings.index');
    Route::get('social_media_settings', [GeneralSettingsController::class, 'getSocialLinksSettings'])->name('specific_settings.social_media_settings');

    Route::get('payment_method_settings', [GeneralSettingsController::class, 'getPaymentMethodsSettings'])->name('specific_settings.payment_method_settings');


    Route::resource('notification_settings', NotificationSettingsController::class);


    Route::get('footer_settings', [GeneralSettingsController::class, 'getFooterSettings'])->name('specific_settings.footer_settings');
    Route::get('configurations', [GeneralSettingsController::class, 'getconfigurationsSettings'])->name('specific_settings.configurations');
    // Route::get('theme_settings', [GeneralSettingsController::class, 'getThemesSettings'])->name('specific_settings.themes');
    Route::get('email/configurations', [GeneralSettingsController::class, 'getEmailconfigurationsSettings'])->name('specific_settings.email.configurations');
    Route::get('home_page_statistics_settings', [GeneralSettingsController::class, 'getHomePageStatisticsSettings'])->name('specific_settings.home_page_statistics_settings');
    Route::get('clear_cache', [GeneralSettingsController::class, 'clearCache'])->name('clear_cache.index');
    Route::get('seo_settings', [GeneralSettingsController::class, 'seoSettings'])->name('seo_settings.index');


    Route::put('general_settings', [GeneralSettingsController::class, 'update'])->name('general_settings.update');
    Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('profile/{user}', [ProfileController::class, 'update'])->name('profile.update');
    Route::resource('roles', RolesController::class);
    Route::get('get_permissions_except_role', [RolesController::class, 'getPermissionsExceptRole'])->name('getPermissionsExceptRole');
    Route::get('view_notifications/{type}', [DashboardController::class, 'viewNotification'])->name('viewNotifications');

    // Content Pages
    Route::get('pages_contents/{section}', [PagesContentsController::class, 'getPageContent'])->name('pages_contents.get');
    Route::put('pages_contents', [PagesContentsController::class, 'update'])->name('pages_contents.update');

    Route::get('not_allowed', [DashboardController::class, 'notAllowed'])->name('not_allowed');

    //Contact
    Route::crudRoutes('contacts', ContactsController::class);


    Route::crudRoutes('gateways', GatewaysController::class);
    Route::crudRoutes('currencies', CurruncyController::class);
    Route::crudRoutes('withdraw_requests', WithdrawRequestsController::class);
    Route::get('version', [VersionUpgradesController::class, 'index'])->name('version_upgrade.index');
    Route::post('version_upgrade', [VersionUpgradesController::class, 'upgrade'])->name('version_upgrade.upgrade');


    Route::get('theme_settings', [ThemeSettingsController::class, 'index'])->name('theme_settings.index');
    Route::put('theme_settings', [ThemeSettingsController::class, 'update'])->name('theme_settings.update');
    Route::get('home_page_settings', [ThemeSettingsController::class, 'homeIndex'])->name('home_page.index');
    Route::put('home_page_settings', [ThemeSettingsController::class, 'homePage'])->name('home_page.update');
    Route::post('home_page_status_settings', [ThemeSettingsController::class, 'homePageStatus'])->name('home_page.status');

    Route::get('system_info',[SystemInformationsController::class, 'index'])->name('system_info.index');

    // Route::get('payment-methods', 'Admin\PaymentMethodController@index')->name('payment.methods');
    // Route::post('payment-methods/deactivate', 'Admin\PaymentMethodController@deactivate')->name('payment.methods.deactivate');
    // Route::get('payment-methods/deactivate', 'Admin\PaymentMethodController@deactivate')->name('payment.methods.deactivate');
    // Route::post('sort-payment-methods', 'Admin\PaymentMethodController@sortPaymentMethods')->name('sort.payment.methods');
    // Route::get('payment-methods/edit/{id}', 'Admin\PaymentMethodController@edit')->name('edit.payment.methods');
    // Route::put('payment-methods/update/{id}', 'Admin\PaymentMethodController@update')->name('update.payment.methods');
});
