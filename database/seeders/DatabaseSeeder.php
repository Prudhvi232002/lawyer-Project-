<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


        $this->call(AllLanguagesTableSeeder::class);
        $this->call(AppointmentRatingsTableSeeder::class);
        $this->call(AppointmentScheduleSlotsTableSeeder::class);
        $this->call(AppointmentSchedulesTableSeeder::class);
        $this->call(AppointmentStatusesTableSeeder::class);
        $this->call(AppointmentTypesTableSeeder::class);
        $this->call(ArchiveCategoriesTableSeeder::class);
        $this->call(ArchiveTagTableSeeder::class);
        $this->call(ArchivesTableSeeder::class);
        $this->call(BankAccountsTableSeeder::class);
        $this->call(BlogCategoriesTableSeeder::class);
        $this->call(BookedAppointmentsTableSeeder::class);
        $this->call(BookedServicesTableSeeder::class);
        $this->call(BroadcastCategoriesTableSeeder::class);
        $this->call(BroadcastTagTableSeeder::class);
        $this->call(BroadcastsTableSeeder::class);
        $this->call(CertificationsTableSeeder::class);
        $this->call(ChangeLogsTableSeeder::class);
        $this->call(CommissionsTableSeeder::class);
        $this->call(CompanyPagesTableSeeder::class);
        $this->call(ContactsTableSeeder::class);
        $this->call(CountriesTableSeeder::class);
        $this->call(CurrenciesTableSeeder::class);
        $this->call(CurrencyCodesTableSeeder::class);
        $this->call(CustomersTableSeeder::class);
        $this->call(EventCategoriesTableSeeder::class);
        $this->call(EventSponsersTableSeeder::class);
        $this->call(EventTagTableSeeder::class);
        $this->call(EventsTableSeeder::class);
        $this->call(FailedJobsTableSeeder::class);
        $this->call(FaqCategoriesTableSeeder::class);
        $this->call(FaqsTableSeeder::class);
        $this->call(FundBankTransfersTableSeeder::class);
        $this->call(FundsTableSeeder::class);
        $this->call(GatewaysTableSeeder::class);
        $this->call(GeneralSettingsTableSeeder::class);
        $this->call(InAppNotificationsTableSeeder::class);
        $this->call(JobsTableSeeder::class);
        $this->call(LanguagesTableSeeder::class);
        $this->call(LawFirmCategoriesTableSeeder::class);
        $this->call(LawFirmCategoryTableSeeder::class);
        $this->call(LawFirmLanguageTableSeeder::class);
        $this->call(LawFirmMainCategoriesTableSeeder::class);
        $this->call(LawFirmReviewsTableSeeder::class);
        $this->call(LawFirmSettingsTableSeeder::class);
        $this->call(LawFirmTagTableSeeder::class);
        $this->call(LawFirmsTableSeeder::class);
        $this->call(LawyerCategoriesTableSeeder::class);
        $this->call(LawyerCategoryTableSeeder::class);
        $this->call(LawyerEducationsTableSeeder::class);
        $this->call(LawyerExperiencesTableSeeder::class);
        $this->call(LawyerLanguageTableSeeder::class);
        $this->call(LawyerMainCategoriesTableSeeder::class);
        $this->call(LawyerPaymentsHistoryTableSeeder::class);
        $this->call(LawyerReviewsTableSeeder::class);
        $this->call(LawyerSettingsTableSeeder::class);
        $this->call(LawyerTagTableSeeder::class);
        $this->call(LawyersTableSeeder::class);
        $this->call(MediaTableSeeder::class);
        $this->call(MediaCategoriesTableSeeder::class);
        $this->call(MessagesTableSeeder::class);
        $this->call(MigrationsTableSeeder::class);
        $this->call(NotificationSettingsTableSeeder::class);
        $this->call(OauthAccessTokensTableSeeder::class);
        $this->call(OauthAuthCodesTableSeeder::class);
        $this->call(OauthClientsTableSeeder::class);
        $this->call(OauthPersonalAccessClientsTableSeeder::class);
        $this->call(OauthRefreshTokensTableSeeder::class);
        $this->call(PagesContentsTableSeeder::class);
        $this->call(PasswordResetsTableSeeder::class);
        $this->call(PersonalAccessTokensTableSeeder::class);
        $this->call(PodcastCategoriesTableSeeder::class);
        $this->call(PodcastTagTableSeeder::class);
        $this->call(PostTagTableSeeder::class);
        $this->call(PostsTableSeeder::class);
        $this->call(PricingPlanModuleTableSeeder::class);
        $this->call(PricingPlanModulesTableSeeder::class);
        $this->call(PricingPlansTableSeeder::class);
        $this->call(RolePermissionTableSeeder::class);
        $this->call(RolePermissionsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(ServiceCategoriesTableSeeder::class);
        $this->call(ServiceFaqsTableSeeder::class);
        $this->call(ServiceReviewsTableSeeder::class);
        $this->call(ServiceStatusesTableSeeder::class);
        $this->call(ServiceTagTableSeeder::class);
        $this->call(ServicesTableSeeder::class);
        $this->call(SessionsTableSeeder::class);
        $this->call(SocialAccountsTableSeeder::class);
        $this->call(StatesTableSeeder::class);
        $this->call(SubscriptionItemsTableSeeder::class);
        $this->call(SubscriptionsTableSeeder::class);
        $this->call(TagsTableSeeder::class);
        $this->call(TestimonialsTableSeeder::class);
        $this->call(TransactionsTableSeeder::class);
        $this->call(TransfersTableSeeder::class);
        $this->call(UserRoleTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(WalletsTableSeeder::class);
        $this->call(WithdrawRequestsTableSeeder::class);
        $this->call(CitiesTableSeeder::class);
        $this->call(PodcastsTableSeeder::class);
        $this->call(PostCommentsTableSeeder::class);
        $this->call(PostLikesTableSeeder::class);
        $this->call(PostSharesTableSeeder::class);
        $this->call(ThemeSettingsTableSeeder::class);
        $this->call(HomeComponentOrdersTableSeeder::class);
        $this->call(AppCarouselTableSeeder::class);
    }
}
