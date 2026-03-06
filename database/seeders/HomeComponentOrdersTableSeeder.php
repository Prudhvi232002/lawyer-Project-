<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class HomeComponentOrdersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('home_component_orders')->delete();
        
        \DB::table('home_component_orders')->insert(array (
            0 => 
            array (
                'id' => 13,
                'name' => 'FeaturedEventSection',
                'display_name' => 'Featured Event Section',
                'description' => 'Description of Featured Event',
                'sort_order' => 11,
                'is_active' => 1,
                'created_at' => '2025-01-10 11:25:24',
                'updated_at' => '2025-01-15 14:35:14',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 12,
                'name' => 'FreeConsultationSection',
                'display_name' => 'Free Consultation Section',
                'description' => 'Description of Free Consultation',
                'sort_order' => 8,
                'is_active' => 1,
                'created_at' => '2025-01-10 11:25:24',
                'updated_at' => '2025-01-15 14:34:13',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 11,
                'name' => 'ServiceCategoriesSection',
                'display_name' => 'Quick Buy Services Section',
                'description' => 'Description of Service Categories',
                'sort_order' => 7,
                'is_active' => 1,
                'created_at' => '2025-01-10 11:25:24',
                'updated_at' => '2025-01-15 15:32:52',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 10,
                'name' => 'FeaturedLawfirmSection',
                'display_name' => 'Featured Law Firm Section',
                'description' => 'Description of Featured Law Firm',
                'sort_order' => 6,
                'is_active' => 1,
                'created_at' => '2025-01-10 11:25:24',
                'updated_at' => '2025-01-15 14:33:57',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 9,
                'name' => 'LawyersTabsSection',
                'display_name' => 'Qualified Lawyer Section',
                'description' => 'Description of Lawyers Tabs',
                'sort_order' => 5,
                'is_active' => 1,
                'created_at' => '2025-01-10 11:25:24',
                'updated_at' => '2025-01-15 15:34:11',
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 8,
                'name' => 'NearestTabSection',
                'display_name' => 'Find Nearest Lawyer Section',
                'description' => 'Description of Nearest Tab',
                'sort_order' => 4,
                'is_active' => 1,
                'created_at' => '2025-01-10 11:25:24',
                'updated_at' => '2025-01-15 14:33:35',
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'SpotlightLawyerSection',
                'display_name' => 'Premium Lawyer Section',
                'description' => 'Description of Spotlight Lawyer',
                'sort_order' => 3,
                'is_active' => 1,
                'created_at' => '2025-01-10 11:25:24',
                'updated_at' => '2025-01-15 15:32:51',
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => 5,
                'name' => 'HomeStatisticsBar',
                'display_name' => 'Home Statistics Bar',
                'description' => 'Description of Home Statistics',
                'sort_order' => 1,
                'is_active' => 1,
                'created_at' => '2025-01-10 11:25:24',
                'updated_at' => '2025-01-10 10:30:21',
                'deleted_at' => NULL,
            ),
            8 => 
            array (
                'id' => 6,
                'name' => 'HomeStaticCardsSection',
                'display_name' => 'Law Categories Section',
                'description' => 'Description of Static Cards',
                'sort_order' => 2,
                'is_active' => 1,
                'created_at' => '2025-01-10 11:25:24',
                'updated_at' => '2025-01-15 14:33:09',
                'deleted_at' => NULL,
            ),
            9 => 
            array (
                'id' => 14,
                'name' => 'FeaturedTestimonialsSection',
                'display_name' => 'About Our Services Section',
                'description' => 'Description of Featured Testimonials',
                'sort_order' => 9,
                'is_active' => 1,
                'created_at' => '2025-01-10 11:25:24',
                'updated_at' => '2025-01-15 14:34:20',
                'deleted_at' => NULL,
            ),
            10 => 
            array (
                'id' => 15,
                'name' => 'AppSection',
                'display_name' => 'Consultant App Section',
                'description' => 'Description of App Section',
                'sort_order' => 10,
                'is_active' => 1,
                'created_at' => '2025-01-10 11:25:24',
                'updated_at' => '2025-01-15 15:34:12',
                'deleted_at' => NULL,
            ),
            11 => 
            array (
                'id' => 16,
                'name' => 'FaqsSection',
                'display_name' => 'FAQs Section',
                'description' => 'Description of FAQs Section',
                'sort_order' => 12,
                'is_active' => 1,
                'created_at' => '2025-01-10 11:25:24',
                'updated_at' => '2025-01-15 14:35:14',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}