<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MigrationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('migrations')->delete();
        
        \DB::table('migrations')->insert(array (
            0 => 
            array (
                'batch' => 1,
                'id' => 217,
                'migration' => '2014_10_12_100000_create_password_resets_table',
            ),
            1 => 
            array (
                'batch' => 1,
                'id' => 218,
                'migration' => '2019_08_19_000000_create_failed_jobs_table',
            ),
            2 => 
            array (
                'batch' => 1,
                'id' => 219,
                'migration' => '2019_12_14_000001_create_personal_access_tokens_table',
            ),
            3 => 
            array (
                'batch' => 2,
                'id' => 220,
                'migration' => '2023_01_10_000000_create_social_accounts_table',
            ),
            4 => 
            array (
                'batch' => 2,
                'id' => 221,
                'migration' => '2023_01_13_174757_create_sessions_table',
            ),
            5 => 
            array (
                'batch' => 2,
                'id' => 222,
                'migration' => '2023_01_13_174757_create_sessions_table',
            ),
            6 => 
            array (
                'batch' => 3,
                'id' => 223,
                'migration' => '2019_05_03_000001_create_customer_columns',
            ),
            7 => 
            array (
                'batch' => 3,
                'id' => 224,
                'migration' => '2019_05_03_000002_create_subscriptions_table',
            ),
            8 => 
            array (
                'batch' => 3,
                'id' => 225,
                'migration' => '2019_05_03_000003_create_subscription_items_table',
            ),
            9 => 
            array (
                'batch' => 0,
                'id' => 226,
                'migration' => '2024_05_21_130724_create_all_languages_table',
            ),
            10 => 
            array (
                'batch' => 0,
                'id' => 227,
                'migration' => '2024_05_21_130724_create_appointment_ratings_table',
            ),
            11 => 
            array (
                'batch' => 0,
                'id' => 228,
                'migration' => '2024_05_21_130724_create_appointment_schedule_slots_table',
            ),
            12 => 
            array (
                'batch' => 0,
                'id' => 229,
                'migration' => '2024_05_21_130724_create_appointment_schedules_table',
            ),
            13 => 
            array (
                'batch' => 0,
                'id' => 230,
                'migration' => '2024_05_21_130724_create_appointment_statuses_table',
            ),
            14 => 
            array (
                'batch' => 0,
                'id' => 231,
                'migration' => '2024_05_21_130724_create_appointment_types_table',
            ),
            15 => 
            array (
                'batch' => 0,
                'id' => 232,
                'migration' => '2024_05_21_130724_create_archive_categories_table',
            ),
            16 => 
            array (
                'batch' => 0,
                'id' => 233,
                'migration' => '2024_05_21_130724_create_archive_tag_table',
            ),
            17 => 
            array (
                'batch' => 0,
                'id' => 234,
                'migration' => '2024_05_21_130724_create_archives_table',
            ),
            18 => 
            array (
                'batch' => 0,
                'id' => 235,
                'migration' => '2024_05_21_130724_create_bank_accounts_table',
            ),
            19 => 
            array (
                'batch' => 0,
                'id' => 236,
                'migration' => '2024_05_21_130724_create_blog_categories_table',
            ),
            20 => 
            array (
                'batch' => 0,
                'id' => 237,
                'migration' => '2024_05_21_130724_create_booked_appointments_table',
            ),
            21 => 
            array (
                'batch' => 0,
                'id' => 238,
                'migration' => '2024_05_21_130724_create_booked_services_table',
            ),
            22 => 
            array (
                'batch' => 0,
                'id' => 239,
                'migration' => '2024_05_21_130724_create_broadcast_categories_table',
            ),
            23 => 
            array (
                'batch' => 0,
                'id' => 240,
                'migration' => '2024_05_21_130724_create_broadcast_tag_table',
            ),
            24 => 
            array (
                'batch' => 0,
                'id' => 241,
                'migration' => '2024_05_21_130724_create_broadcasts_table',
            ),
            25 => 
            array (
                'batch' => 0,
                'id' => 242,
                'migration' => '2024_05_21_130724_create_certifications_table',
            ),
            26 => 
            array (
                'batch' => 0,
                'id' => 243,
                'migration' => '2024_05_21_130724_create_change_logs_table',
            ),
            27 => 
            array (
                'batch' => 0,
                'id' => 244,
                'migration' => '2024_05_21_130724_create_cities_table',
            ),
            28 => 
            array (
                'batch' => 0,
                'id' => 245,
                'migration' => '2024_05_21_130724_create_commissions_table',
            ),
            29 => 
            array (
                'batch' => 0,
                'id' => 246,
                'migration' => '2024_05_21_130724_create_company_pages_table',
            ),
            30 => 
            array (
                'batch' => 0,
                'id' => 247,
                'migration' => '2024_05_21_130724_create_contacts_table',
            ),
            31 => 
            array (
                'batch' => 0,
                'id' => 248,
                'migration' => '2024_05_21_130724_create_countries_table',
            ),
            32 => 
            array (
                'batch' => 0,
                'id' => 249,
                'migration' => '2024_05_21_130724_create_currencies_table',
            ),
            33 => 
            array (
                'batch' => 0,
                'id' => 250,
                'migration' => '2024_05_21_130724_create_currency_codes_table',
            ),
            34 => 
            array (
                'batch' => 0,
                'id' => 251,
                'migration' => '2024_05_21_130724_create_customers_table',
            ),
            35 => 
            array (
                'batch' => 0,
                'id' => 252,
                'migration' => '2024_05_21_130724_create_event_categories_table',
            ),
            36 => 
            array (
                'batch' => 0,
                'id' => 253,
                'migration' => '2024_05_21_130724_create_event_sponsers_table',
            ),
            37 => 
            array (
                'batch' => 0,
                'id' => 254,
                'migration' => '2024_05_21_130724_create_event_tag_table',
            ),
            38 => 
            array (
                'batch' => 0,
                'id' => 255,
                'migration' => '2024_05_21_130724_create_events_table',
            ),
            39 => 
            array (
                'batch' => 0,
                'id' => 256,
                'migration' => '2024_05_21_130724_create_failed_jobs_table',
            ),
            40 => 
            array (
                'batch' => 0,
                'id' => 257,
                'migration' => '2024_05_21_130724_create_faq_categories_table',
            ),
            41 => 
            array (
                'batch' => 0,
                'id' => 258,
                'migration' => '2024_05_21_130724_create_faqs_table',
            ),
            42 => 
            array (
                'batch' => 0,
                'id' => 259,
                'migration' => '2024_05_21_130724_create_fund_bank_transfers_table',
            ),
            43 => 
            array (
                'batch' => 0,
                'id' => 260,
                'migration' => '2024_05_21_130724_create_funds_table',
            ),
            44 => 
            array (
                'batch' => 0,
                'id' => 261,
                'migration' => '2024_05_21_130724_create_gateways_table',
            ),
            45 => 
            array (
                'batch' => 0,
                'id' => 262,
                'migration' => '2024_05_21_130724_create_general_settings_table',
            ),
            46 => 
            array (
                'batch' => 0,
                'id' => 263,
                'migration' => '2024_05_21_130724_create_in_app_notifications_table',
            ),
            47 => 
            array (
                'batch' => 0,
                'id' => 264,
                'migration' => '2024_05_21_130724_create_jobs_table',
            ),
            48 => 
            array (
                'batch' => 0,
                'id' => 265,
                'migration' => '2024_05_21_130724_create_languages_table',
            ),
            49 => 
            array (
                'batch' => 0,
                'id' => 266,
                'migration' => '2024_05_21_130724_create_law_firm_categories_table',
            ),
            50 => 
            array (
                'batch' => 0,
                'id' => 267,
                'migration' => '2024_05_21_130724_create_law_firm_category_table',
            ),
            51 => 
            array (
                'batch' => 0,
                'id' => 268,
                'migration' => '2024_05_21_130724_create_law_firm_language_table',
            ),
            52 => 
            array (
                'batch' => 0,
                'id' => 269,
                'migration' => '2024_05_21_130724_create_law_firm_main_categories_table',
            ),
            53 => 
            array (
                'batch' => 0,
                'id' => 270,
                'migration' => '2024_05_21_130724_create_law_firm_reviews_table',
            ),
            54 => 
            array (
                'batch' => 0,
                'id' => 271,
                'migration' => '2024_05_21_130724_create_law_firm_settings_table',
            ),
            55 => 
            array (
                'batch' => 0,
                'id' => 272,
                'migration' => '2024_05_21_130724_create_law_firm_tag_table',
            ),
            56 => 
            array (
                'batch' => 0,
                'id' => 273,
                'migration' => '2024_05_21_130724_create_law_firms_table',
            ),
            57 => 
            array (
                'batch' => 0,
                'id' => 274,
                'migration' => '2024_05_21_130724_create_lawyer_categories_table',
            ),
            58 => 
            array (
                'batch' => 0,
                'id' => 275,
                'migration' => '2024_05_21_130724_create_lawyer_category_table',
            ),
            59 => 
            array (
                'batch' => 0,
                'id' => 276,
                'migration' => '2024_05_21_130724_create_lawyer_educations_table',
            ),
            60 => 
            array (
                'batch' => 0,
                'id' => 277,
                'migration' => '2024_05_21_130724_create_lawyer_experiences_table',
            ),
            61 => 
            array (
                'batch' => 0,
                'id' => 278,
                'migration' => '2024_05_21_130724_create_lawyer_language_table',
            ),
            62 => 
            array (
                'batch' => 0,
                'id' => 279,
                'migration' => '2024_05_21_130724_create_lawyer_main_categories_table',
            ),
            63 => 
            array (
                'batch' => 0,
                'id' => 280,
                'migration' => '2024_05_21_130724_create_lawyer_payments_history_table',
            ),
            64 => 
            array (
                'batch' => 0,
                'id' => 281,
                'migration' => '2024_05_21_130724_create_lawyer_reviews_table',
            ),
            65 => 
            array (
                'batch' => 0,
                'id' => 282,
                'migration' => '2024_05_21_130724_create_lawyer_settings_table',
            ),
            66 => 
            array (
                'batch' => 0,
                'id' => 283,
                'migration' => '2024_05_21_130724_create_lawyer_tag_table',
            ),
            67 => 
            array (
                'batch' => 0,
                'id' => 284,
                'migration' => '2024_05_21_130724_create_lawyers_table',
            ),
            68 => 
            array (
                'batch' => 0,
                'id' => 285,
                'migration' => '2024_05_21_130724_create_media_table',
            ),
            69 => 
            array (
                'batch' => 0,
                'id' => 286,
                'migration' => '2024_05_21_130724_create_media_categories_table',
            ),
            70 => 
            array (
                'batch' => 0,
                'id' => 287,
                'migration' => '2024_05_21_130724_create_messages_table',
            ),
            71 => 
            array (
                'batch' => 0,
                'id' => 288,
                'migration' => '2024_05_21_130724_create_notification_settings_table',
            ),
            72 => 
            array (
                'batch' => 0,
                'id' => 289,
                'migration' => '2024_05_21_130724_create_oauth_access_tokens_table',
            ),
            73 => 
            array (
                'batch' => 0,
                'id' => 290,
                'migration' => '2024_05_21_130724_create_oauth_auth_codes_table',
            ),
            74 => 
            array (
                'batch' => 0,
                'id' => 291,
                'migration' => '2024_05_21_130724_create_oauth_clients_table',
            ),
            75 => 
            array (
                'batch' => 0,
                'id' => 292,
                'migration' => '2024_05_21_130724_create_oauth_personal_access_clients_table',
            ),
            76 => 
            array (
                'batch' => 0,
                'id' => 293,
                'migration' => '2024_05_21_130724_create_oauth_refresh_tokens_table',
            ),
            77 => 
            array (
                'batch' => 0,
                'id' => 294,
                'migration' => '2024_05_21_130724_create_pages_contents_table',
            ),
            78 => 
            array (
                'batch' => 0,
                'id' => 295,
                'migration' => '2024_05_21_130724_create_password_resets_table',
            ),
            79 => 
            array (
                'batch' => 0,
                'id' => 296,
                'migration' => '2024_05_21_130724_create_personal_access_tokens_table',
            ),
            80 => 
            array (
                'batch' => 0,
                'id' => 297,
                'migration' => '2024_05_21_130724_create_podcast_categories_table',
            ),
            81 => 
            array (
                'batch' => 0,
                'id' => 298,
                'migration' => '2024_05_21_130724_create_podcast_tag_table',
            ),
            82 => 
            array (
                'batch' => 0,
                'id' => 299,
                'migration' => '2024_05_21_130724_create_podcasts_table',
            ),
            83 => 
            array (
                'batch' => 0,
                'id' => 300,
                'migration' => '2024_05_21_130724_create_post_tag_table',
            ),
            84 => 
            array (
                'batch' => 0,
                'id' => 301,
                'migration' => '2024_05_21_130724_create_posts_table',
            ),
            85 => 
            array (
                'batch' => 0,
                'id' => 302,
                'migration' => '2024_05_21_130724_create_pricing_plan_module_table',
            ),
            86 => 
            array (
                'batch' => 0,
                'id' => 303,
                'migration' => '2024_05_21_130724_create_pricing_plan_modules_table',
            ),
            87 => 
            array (
                'batch' => 0,
                'id' => 304,
                'migration' => '2024_05_21_130724_create_pricing_plans_table',
            ),
            88 => 
            array (
                'batch' => 0,
                'id' => 305,
                'migration' => '2024_05_21_130724_create_role_permission_table',
            ),
            89 => 
            array (
                'batch' => 0,
                'id' => 306,
                'migration' => '2024_05_21_130724_create_role_permissions_table',
            ),
            90 => 
            array (
                'batch' => 0,
                'id' => 307,
                'migration' => '2024_05_21_130724_create_roles_table',
            ),
            91 => 
            array (
                'batch' => 0,
                'id' => 308,
                'migration' => '2024_05_21_130724_create_service_categories_table',
            ),
            92 => 
            array (
                'batch' => 0,
                'id' => 309,
                'migration' => '2024_05_21_130724_create_service_faqs_table',
            ),
            93 => 
            array (
                'batch' => 0,
                'id' => 310,
                'migration' => '2024_05_21_130724_create_service_reviews_table',
            ),
            94 => 
            array (
                'batch' => 0,
                'id' => 311,
                'migration' => '2024_05_21_130724_create_service_statuses_table',
            ),
            95 => 
            array (
                'batch' => 0,
                'id' => 312,
                'migration' => '2024_05_21_130724_create_service_tag_table',
            ),
            96 => 
            array (
                'batch' => 0,
                'id' => 313,
                'migration' => '2024_05_21_130724_create_services_table',
            ),
            97 => 
            array (
                'batch' => 0,
                'id' => 314,
                'migration' => '2024_05_21_130724_create_sessions_table',
            ),
            98 => 
            array (
                'batch' => 0,
                'id' => 315,
                'migration' => '2024_05_21_130724_create_social_accounts_table',
            ),
            99 => 
            array (
                'batch' => 0,
                'id' => 316,
                'migration' => '2024_05_21_130724_create_states_table',
            ),
        ));
        \DB::table('migrations')->insert(array (
            0 => 
            array (
                'batch' => 0,
                'id' => 317,
                'migration' => '2024_05_21_130724_create_subscription_items_table',
            ),
            1 => 
            array (
                'batch' => 0,
                'id' => 318,
                'migration' => '2024_05_21_130724_create_subscriptions_table',
            ),
            2 => 
            array (
                'batch' => 0,
                'id' => 319,
                'migration' => '2024_05_21_130724_create_tags_table',
            ),
            3 => 
            array (
                'batch' => 0,
                'id' => 320,
                'migration' => '2024_05_21_130724_create_testimonials_table',
            ),
            4 => 
            array (
                'batch' => 0,
                'id' => 321,
                'migration' => '2024_05_21_130724_create_transactions_table',
            ),
            5 => 
            array (
                'batch' => 0,
                'id' => 322,
                'migration' => '2024_05_21_130724_create_transfers_table',
            ),
            6 => 
            array (
                'batch' => 0,
                'id' => 323,
                'migration' => '2024_05_21_130724_create_user_role_table',
            ),
            7 => 
            array (
                'batch' => 0,
                'id' => 324,
                'migration' => '2024_05_21_130724_create_users_table',
            ),
            8 => 
            array (
                'batch' => 0,
                'id' => 325,
                'migration' => '2024_05_21_130724_create_wallets_table',
            ),
            9 => 
            array (
                'batch' => 0,
                'id' => 326,
                'migration' => '2024_05_21_130724_create_withdraw_requests_table',
            ),
            10 => 
            array (
                'batch' => 0,
                'id' => 327,
                'migration' => '2024_05_21_130727_add_foreign_keys_to_states_table',
            ),
            11 => 
            array (
                'batch' => 0,
                'id' => 328,
                'migration' => '2024_05_21_130727_add_foreign_keys_to_transactions_table',
            ),
            12 => 
            array (
                'batch' => 0,
                'id' => 329,
                'migration' => '2024_05_21_130727_add_foreign_keys_to_transfers_table',
            ),
            13 => 
            array (
                'batch' => 0,
                'id' => 330,
                'migration' => '2024_06_13_082725_create_all_languages_table',
            ),
            14 => 
            array (
                'batch' => 0,
                'id' => 331,
                'migration' => '2024_06_13_082725_create_appointment_ratings_table',
            ),
            15 => 
            array (
                'batch' => 0,
                'id' => 332,
                'migration' => '2024_06_13_082725_create_appointment_schedule_slots_table',
            ),
            16 => 
            array (
                'batch' => 0,
                'id' => 333,
                'migration' => '2024_06_13_082725_create_appointment_schedules_table',
            ),
            17 => 
            array (
                'batch' => 0,
                'id' => 334,
                'migration' => '2024_06_13_082725_create_appointment_statuses_table',
            ),
            18 => 
            array (
                'batch' => 0,
                'id' => 335,
                'migration' => '2024_06_13_082725_create_appointment_types_table',
            ),
            19 => 
            array (
                'batch' => 0,
                'id' => 336,
                'migration' => '2024_06_13_082725_create_archive_categories_table',
            ),
            20 => 
            array (
                'batch' => 0,
                'id' => 337,
                'migration' => '2024_06_13_082725_create_archive_tag_table',
            ),
            21 => 
            array (
                'batch' => 0,
                'id' => 338,
                'migration' => '2024_06_13_082725_create_archives_table',
            ),
            22 => 
            array (
                'batch' => 0,
                'id' => 339,
                'migration' => '2024_06_13_082725_create_bank_accounts_table',
            ),
            23 => 
            array (
                'batch' => 0,
                'id' => 340,
                'migration' => '2024_06_13_082725_create_blog_categories_table',
            ),
            24 => 
            array (
                'batch' => 0,
                'id' => 341,
                'migration' => '2024_06_13_082725_create_booked_appointments_table',
            ),
            25 => 
            array (
                'batch' => 0,
                'id' => 342,
                'migration' => '2024_06_13_082725_create_booked_services_table',
            ),
            26 => 
            array (
                'batch' => 0,
                'id' => 343,
                'migration' => '2024_06_13_082725_create_broadcast_categories_table',
            ),
            27 => 
            array (
                'batch' => 0,
                'id' => 344,
                'migration' => '2024_06_13_082725_create_broadcast_tag_table',
            ),
            28 => 
            array (
                'batch' => 0,
                'id' => 345,
                'migration' => '2024_06_13_082725_create_broadcasts_table',
            ),
            29 => 
            array (
                'batch' => 0,
                'id' => 346,
                'migration' => '2024_06_13_082725_create_certifications_table',
            ),
            30 => 
            array (
                'batch' => 0,
                'id' => 347,
                'migration' => '2024_06_13_082725_create_change_logs_table',
            ),
            31 => 
            array (
                'batch' => 0,
                'id' => 348,
                'migration' => '2024_06_13_082725_create_cities_table',
            ),
            32 => 
            array (
                'batch' => 0,
                'id' => 349,
                'migration' => '2024_06_13_082725_create_commissions_table',
            ),
            33 => 
            array (
                'batch' => 0,
                'id' => 350,
                'migration' => '2024_06_13_082725_create_company_pages_table',
            ),
            34 => 
            array (
                'batch' => 0,
                'id' => 351,
                'migration' => '2024_06_13_082725_create_contacts_table',
            ),
            35 => 
            array (
                'batch' => 0,
                'id' => 352,
                'migration' => '2024_06_13_082725_create_countries_table',
            ),
            36 => 
            array (
                'batch' => 0,
                'id' => 353,
                'migration' => '2024_06_13_082725_create_currencies_table',
            ),
            37 => 
            array (
                'batch' => 0,
                'id' => 354,
                'migration' => '2024_06_13_082725_create_currency_codes_table',
            ),
            38 => 
            array (
                'batch' => 0,
                'id' => 355,
                'migration' => '2024_06_13_082725_create_customers_table',
            ),
            39 => 
            array (
                'batch' => 0,
                'id' => 356,
                'migration' => '2024_06_13_082725_create_event_categories_table',
            ),
            40 => 
            array (
                'batch' => 0,
                'id' => 357,
                'migration' => '2024_06_13_082725_create_event_sponsers_table',
            ),
            41 => 
            array (
                'batch' => 0,
                'id' => 358,
                'migration' => '2024_06_13_082725_create_event_tag_table',
            ),
            42 => 
            array (
                'batch' => 0,
                'id' => 359,
                'migration' => '2024_06_13_082725_create_events_table',
            ),
            43 => 
            array (
                'batch' => 0,
                'id' => 360,
                'migration' => '2024_06_13_082725_create_failed_jobs_table',
            ),
            44 => 
            array (
                'batch' => 0,
                'id' => 361,
                'migration' => '2024_06_13_082725_create_faq_categories_table',
            ),
            45 => 
            array (
                'batch' => 0,
                'id' => 362,
                'migration' => '2024_06_13_082725_create_faqs_table',
            ),
            46 => 
            array (
                'batch' => 0,
                'id' => 363,
                'migration' => '2024_06_13_082725_create_fund_bank_transfers_table',
            ),
            47 => 
            array (
                'batch' => 0,
                'id' => 364,
                'migration' => '2024_06_13_082725_create_funds_table',
            ),
            48 => 
            array (
                'batch' => 0,
                'id' => 365,
                'migration' => '2024_06_13_082725_create_gateways_table',
            ),
            49 => 
            array (
                'batch' => 0,
                'id' => 366,
                'migration' => '2024_06_13_082725_create_general_settings_table',
            ),
            50 => 
            array (
                'batch' => 0,
                'id' => 367,
                'migration' => '2024_06_13_082725_create_in_app_notifications_table',
            ),
            51 => 
            array (
                'batch' => 0,
                'id' => 368,
                'migration' => '2024_06_13_082725_create_jobs_table',
            ),
            52 => 
            array (
                'batch' => 0,
                'id' => 369,
                'migration' => '2024_06_13_082725_create_languages_table',
            ),
            53 => 
            array (
                'batch' => 0,
                'id' => 370,
                'migration' => '2024_06_13_082725_create_law_firm_categories_table',
            ),
            54 => 
            array (
                'batch' => 0,
                'id' => 371,
                'migration' => '2024_06_13_082725_create_law_firm_category_table',
            ),
            55 => 
            array (
                'batch' => 0,
                'id' => 372,
                'migration' => '2024_06_13_082725_create_law_firm_language_table',
            ),
            56 => 
            array (
                'batch' => 0,
                'id' => 373,
                'migration' => '2024_06_13_082725_create_law_firm_main_categories_table',
            ),
            57 => 
            array (
                'batch' => 0,
                'id' => 374,
                'migration' => '2024_06_13_082725_create_law_firm_reviews_table',
            ),
            58 => 
            array (
                'batch' => 0,
                'id' => 375,
                'migration' => '2024_06_13_082725_create_law_firm_settings_table',
            ),
            59 => 
            array (
                'batch' => 0,
                'id' => 376,
                'migration' => '2024_06_13_082725_create_law_firm_tag_table',
            ),
            60 => 
            array (
                'batch' => 0,
                'id' => 377,
                'migration' => '2024_06_13_082725_create_law_firms_table',
            ),
            61 => 
            array (
                'batch' => 0,
                'id' => 378,
                'migration' => '2024_06_13_082725_create_lawyer_categories_table',
            ),
            62 => 
            array (
                'batch' => 0,
                'id' => 379,
                'migration' => '2024_06_13_082725_create_lawyer_category_table',
            ),
            63 => 
            array (
                'batch' => 0,
                'id' => 380,
                'migration' => '2024_06_13_082725_create_lawyer_educations_table',
            ),
            64 => 
            array (
                'batch' => 0,
                'id' => 381,
                'migration' => '2024_06_13_082725_create_lawyer_experiences_table',
            ),
            65 => 
            array (
                'batch' => 0,
                'id' => 382,
                'migration' => '2024_06_13_082725_create_lawyer_language_table',
            ),
            66 => 
            array (
                'batch' => 0,
                'id' => 383,
                'migration' => '2024_06_13_082725_create_lawyer_main_categories_table',
            ),
            67 => 
            array (
                'batch' => 0,
                'id' => 384,
                'migration' => '2024_06_13_082725_create_lawyer_payments_history_table',
            ),
            68 => 
            array (
                'batch' => 0,
                'id' => 385,
                'migration' => '2024_06_13_082725_create_lawyer_reviews_table',
            ),
            69 => 
            array (
                'batch' => 0,
                'id' => 386,
                'migration' => '2024_06_13_082725_create_lawyer_settings_table',
            ),
            70 => 
            array (
                'batch' => 0,
                'id' => 387,
                'migration' => '2024_06_13_082725_create_lawyer_tag_table',
            ),
            71 => 
            array (
                'batch' => 0,
                'id' => 388,
                'migration' => '2024_06_13_082725_create_lawyers_table',
            ),
            72 => 
            array (
                'batch' => 0,
                'id' => 389,
                'migration' => '2024_06_13_082725_create_media_table',
            ),
            73 => 
            array (
                'batch' => 0,
                'id' => 390,
                'migration' => '2024_06_13_082725_create_media_categories_table',
            ),
            74 => 
            array (
                'batch' => 0,
                'id' => 391,
                'migration' => '2024_06_13_082725_create_messages_table',
            ),
            75 => 
            array (
                'batch' => 0,
                'id' => 392,
                'migration' => '2024_06_13_082725_create_notification_settings_table',
            ),
            76 => 
            array (
                'batch' => 0,
                'id' => 393,
                'migration' => '2024_06_13_082725_create_oauth_access_tokens_table',
            ),
            77 => 
            array (
                'batch' => 0,
                'id' => 394,
                'migration' => '2024_06_13_082725_create_oauth_auth_codes_table',
            ),
            78 => 
            array (
                'batch' => 0,
                'id' => 395,
                'migration' => '2024_06_13_082725_create_oauth_clients_table',
            ),
            79 => 
            array (
                'batch' => 0,
                'id' => 396,
                'migration' => '2024_06_13_082725_create_oauth_personal_access_clients_table',
            ),
            80 => 
            array (
                'batch' => 0,
                'id' => 397,
                'migration' => '2024_06_13_082725_create_oauth_refresh_tokens_table',
            ),
            81 => 
            array (
                'batch' => 0,
                'id' => 398,
                'migration' => '2024_06_13_082725_create_pages_contents_table',
            ),
            82 => 
            array (
                'batch' => 0,
                'id' => 399,
                'migration' => '2024_06_13_082725_create_password_resets_table',
            ),
            83 => 
            array (
                'batch' => 0,
                'id' => 400,
                'migration' => '2024_06_13_082725_create_personal_access_tokens_table',
            ),
            84 => 
            array (
                'batch' => 0,
                'id' => 401,
                'migration' => '2024_06_13_082725_create_podcast_categories_table',
            ),
            85 => 
            array (
                'batch' => 0,
                'id' => 402,
                'migration' => '2024_06_13_082725_create_podcast_tag_table',
            ),
            86 => 
            array (
                'batch' => 0,
                'id' => 403,
                'migration' => '2024_06_13_082725_create_podcasts_table',
            ),
            87 => 
            array (
                'batch' => 0,
                'id' => 404,
                'migration' => '2024_06_13_082725_create_post_tag_table',
            ),
            88 => 
            array (
                'batch' => 0,
                'id' => 405,
                'migration' => '2024_06_13_082725_create_posts_table',
            ),
            89 => 
            array (
                'batch' => 0,
                'id' => 406,
                'migration' => '2024_06_13_082725_create_pricing_plan_module_table',
            ),
            90 => 
            array (
                'batch' => 0,
                'id' => 407,
                'migration' => '2024_06_13_082725_create_pricing_plan_modules_table',
            ),
            91 => 
            array (
                'batch' => 0,
                'id' => 408,
                'migration' => '2024_06_13_082725_create_pricing_plans_table',
            ),
            92 => 
            array (
                'batch' => 0,
                'id' => 409,
                'migration' => '2024_06_13_082725_create_role_permission_table',
            ),
            93 => 
            array (
                'batch' => 0,
                'id' => 410,
                'migration' => '2024_06_13_082725_create_role_permissions_table',
            ),
            94 => 
            array (
                'batch' => 0,
                'id' => 411,
                'migration' => '2024_06_13_082725_create_roles_table',
            ),
            95 => 
            array (
                'batch' => 0,
                'id' => 412,
                'migration' => '2024_06_13_082725_create_service_categories_table',
            ),
            96 => 
            array (
                'batch' => 0,
                'id' => 413,
                'migration' => '2024_06_13_082725_create_service_faqs_table',
            ),
            97 => 
            array (
                'batch' => 0,
                'id' => 414,
                'migration' => '2024_06_13_082725_create_service_reviews_table',
            ),
            98 => 
            array (
                'batch' => 0,
                'id' => 415,
                'migration' => '2024_06_13_082725_create_service_statuses_table',
            ),
            99 => 
            array (
                'batch' => 0,
                'id' => 416,
                'migration' => '2024_06_13_082725_create_service_tag_table',
            ),
        ));
        \DB::table('migrations')->insert(array (
            0 => 
            array (
                'batch' => 0,
                'id' => 417,
                'migration' => '2024_06_13_082725_create_services_table',
            ),
            1 => 
            array (
                'batch' => 0,
                'id' => 418,
                'migration' => '2024_06_13_082725_create_sessions_table',
            ),
            2 => 
            array (
                'batch' => 0,
                'id' => 419,
                'migration' => '2024_06_13_082725_create_social_accounts_table',
            ),
            3 => 
            array (
                'batch' => 0,
                'id' => 420,
                'migration' => '2024_06_13_082725_create_states_table',
            ),
            4 => 
            array (
                'batch' => 0,
                'id' => 421,
                'migration' => '2024_06_13_082725_create_subscription_items_table',
            ),
            5 => 
            array (
                'batch' => 0,
                'id' => 422,
                'migration' => '2024_06_13_082725_create_subscriptions_table',
            ),
            6 => 
            array (
                'batch' => 0,
                'id' => 423,
                'migration' => '2024_06_13_082725_create_tags_table',
            ),
            7 => 
            array (
                'batch' => 0,
                'id' => 424,
                'migration' => '2024_06_13_082725_create_testimonials_table',
            ),
            8 => 
            array (
                'batch' => 0,
                'id' => 425,
                'migration' => '2024_06_13_082725_create_transactions_table',
            ),
            9 => 
            array (
                'batch' => 0,
                'id' => 426,
                'migration' => '2024_06_13_082725_create_transfers_table',
            ),
            10 => 
            array (
                'batch' => 0,
                'id' => 427,
                'migration' => '2024_06_13_082725_create_user_role_table',
            ),
            11 => 
            array (
                'batch' => 0,
                'id' => 428,
                'migration' => '2024_06_13_082725_create_users_table',
            ),
            12 => 
            array (
                'batch' => 0,
                'id' => 429,
                'migration' => '2024_06_13_082725_create_wallets_table',
            ),
            13 => 
            array (
                'batch' => 0,
                'id' => 430,
                'migration' => '2024_06_13_082725_create_withdraw_requests_table',
            ),
            14 => 
            array (
                'batch' => 0,
                'id' => 431,
                'migration' => '2024_06_13_082728_add_foreign_keys_to_states_table',
            ),
        ));
        
        
    }
}