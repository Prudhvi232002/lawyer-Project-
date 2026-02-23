<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PricingPlanModulesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('pricing_plan_modules')->delete();
        
        \DB::table('pricing_plan_modules')->insert(array (
            0 => 
            array (
                'created_at' => '2023-02-18 21:31:24',
                'display_name' => 'Lists their services & Location.',
                'id' => 1,
                'module_code' => 'lawyer-list-services',
                'sort_order' => 2,
                'type' => 'lawyer',
                'updated_at' => '2023-02-13 20:11:58',
            ),
            1 => 
            array (
                'created_at' => '2023-03-15 22:22:13',
                'display_name' => 'Basic Profile',
                'id' => 2,
                'module_code' => 'lawyer-basic-profile',
                'sort_order' => 1,
                'type' => 'lawyer',
                'updated_at' => '2023-02-13 20:12:11',
            ),
            2 => 
            array (
                'created_at' => '2023-02-18 21:32:05',
                'display_name' => 'Add Social Media contact information
',
                'id' => 4,
                'module_code' => 'lawyer-social-info',
                'sort_order' => 4,
                'type' => 'lawyer',
                'updated_at' => '2023-02-13 20:11:58',
            ),
            3 => 
            array (
                'created_at' => '2023-02-18 21:32:07',
                'display_name' => 'Profile displays',
                'id' => 5,
                'module_code' => 'lawyer-profile-display',
                'sort_order' => 5,
                'type' => 'lawyer',
                'updated_at' => '2023-02-13 20:11:58',
            ),
            4 => 
            array (
                'created_at' => '2023-09-13 15:25:27',
                'display_name' => 'Calendly Integration',
                'id' => 6,
                'module_code' => 'lawyer-calendly',
                'sort_order' => 6,
                'type' => 'lawyer',
                'updated_at' => '2023-02-13 20:11:58',
            ),
            5 => 
            array (
                'created_at' => '2023-03-14 23:52:59',
                'display_name' => 'List Events',
                'id' => 7,
                'module_code' => 'lawyer-events',
                'sort_order' => 7,
                'type' => 'lawyer',
                'updated_at' => '2023-02-13 20:11:58',
            ),
            6 => 
            array (
                'created_at' => '2023-10-05 14:50:50',
                'display_name' => 'List Media',
                'id' => 8,
                'module_code' => 'lawyer-broadcasts',
                'sort_order' => 8,
                'type' => 'lawyer',
                'updated_at' => '2023-02-13 20:11:58',
            ),
            7 => 
            array (
                'created_at' => '2023-02-18 21:32:21',
                'display_name' => 'Blogs',
                'id' => 9,
                'module_code' => 'lawyer-blogs',
                'sort_order' => 9,
                'type' => 'lawyer',
                'updated_at' => '2023-02-13 20:11:58',
            ),
            8 => 
            array (
                'created_at' => '2023-02-18 21:32:21',
                'display_name' => 'List Courses',
                'id' => 10,
                'module_code' => 'lawyer-archives',
                'sort_order' => 9,
                'type' => 'lawyer',
                'updated_at' => '2023-02-13 20:11:58',
            ),
            9 => 
            array (
                'created_at' => '2023-02-18 21:32:21',
                'display_name' => 'list podcasts',
                'id' => 11,
                'module_code' => 'lawyer-podcasts',
                'sort_order' => 9,
                'type' => 'lawyer',
                'updated_at' => '2023-02-13 20:11:58',
            ),
            10 => 
            array (
                'created_at' => '2023-02-18 21:31:24',
                'display_name' => 'Lists their services & Location.',
                'id' => 12,
                'module_code' => 'law_firm-list-services',
                'sort_order' => 2,
                'type' => 'law_firm',
                'updated_at' => '2023-02-13 20:11:58',
            ),
            11 => 
            array (
                'created_at' => '2023-02-18 21:32:02',
                'display_name' => 'Basic Profile',
                'id' => 13,
                'module_code' => 'law_firm-basic-profile',
                'sort_order' => 3,
                'type' => 'law_firm',
                'updated_at' => '2023-02-13 20:11:58',
            ),
            12 => 
            array (
                'created_at' => '2023-02-18 21:32:05',
                'display_name' => 'Add Social Media contact information
',
                'id' => 14,
                'module_code' => 'law_firm-social-info',
                'sort_order' => 4,
                'type' => 'law_firm',
                'updated_at' => '2023-02-13 20:11:58',
            ),
            13 => 
            array (
                'created_at' => '2023-02-18 21:32:07',
                'display_name' => 'Profile displays',
                'id' => 15,
                'module_code' => 'law_firm-profile-display',
                'sort_order' => 5,
                'type' => 'law_firm',
                'updated_at' => '2023-02-13 20:11:58',
            ),
            14 => 
            array (
                'created_at' => '2023-02-18 21:32:11',
                'display_name' => 'Calendly Integration',
                'id' => 16,
                'module_code' => 'law_firm-calendly-integration',
                'sort_order' => 6,
                'type' => 'law_firm',
                'updated_at' => '2023-02-13 20:11:58',
            ),
            15 => 
            array (
                'created_at' => '2023-03-14 23:52:59',
                'display_name' => 'List Events',
                'id' => 17,
                'module_code' => 'law_firm-events',
                'sort_order' => 7,
                'type' => 'law_firm',
                'updated_at' => '2023-02-13 20:11:58',
            ),
            16 => 
            array (
                'created_at' => '2023-10-05 14:51:04',
                'display_name' => 'List Media',
                'id' => 18,
                'module_code' => 'law_firm-broadcasts',
                'sort_order' => 8,
                'type' => 'law_firm',
                'updated_at' => '2023-02-13 20:11:58',
            ),
            17 => 
            array (
                'created_at' => '2023-02-18 21:32:21',
                'display_name' => 'Blogs',
                'id' => 19,
                'module_code' => 'law_firm-blogs',
                'sort_order' => 9,
                'type' => 'law_firm',
                'updated_at' => '2023-02-13 20:11:58',
            ),
            18 => 
            array (
                'created_at' => '2023-02-18 21:32:21',
                'display_name' => 'List Courses',
                'id' => 20,
                'module_code' => 'law_firm-archives',
                'sort_order' => 9,
                'type' => 'law_firm',
                'updated_at' => '2023-02-13 20:11:58',
            ),
            19 => 
            array (
                'created_at' => '2023-02-18 21:32:21',
                'display_name' => 'list podcasts',
                'id' => 21,
                'module_code' => 'law_firm-podcasts',
                'sort_order' => 9,
                'type' => 'law_firm',
                'updated_at' => '2023-02-13 20:11:58',
            ),
            20 => 
            array (
                'created_at' => '2023-02-18 21:32:21',
                'display_name' => 'Lawyer Certifications',
                'id' => 22,
                'module_code' => 'lawyer-certifications',
                'sort_order' => 9,
                'type' => 'lawyer',
                'updated_at' => '2023-02-13 20:11:58',
            ),
            21 => 
            array (
                'created_at' => '2023-02-18 21:32:21',
                'display_name' => 'Lawyer Appointments',
                'id' => 23,
                'module_code' => 'lawyer-appointment',
                'sort_order' => 9,
                'type' => 'lawyer',
                'updated_at' => '2023-02-13 20:11:58',
            ),
            22 => 
            array (
                'created_at' => '2023-09-13 15:36:38',
                'display_name' => 'Lawyer Certifications',
                'id' => 24,
                'module_code' => 'law_firm-certifications',
                'sort_order' => 9,
                'type' => 'law_firm',
                'updated_at' => '2023-02-13 20:11:58',
            ),
            23 => 
            array (
                'created_at' => '2023-09-13 15:36:44',
                'display_name' => 'Lawyer Appointments',
                'id' => 25,
                'module_code' => 'law_firm-appointment',
                'sort_order' => 9,
                'type' => 'law_firm',
                'updated_at' => '2023-02-13 20:11:58',
            ),
            24 => 
            array (
                'created_at' => '2023-02-19 02:32:21',
                'display_name' => 'Certifications',
                'id' => 26,
                'module_code' => 'law_firm-certifications',
                'sort_order' => 9,
                'type' => 'law_firm',
                'updated_at' => '2023-02-13 20:11:58',
            ),
            25 => 
            array (
                'created_at' => '2023-02-19 02:32:21',
                'display_name' => 'Broadcasts',
                'id' => 27,
                'module_code' => 'law_firm-broadcasts',
                'sort_order' => 9,
                'type' => 'law_firm',
                'updated_at' => '2023-02-13 20:11:58',
            ),
            26 => 
            array (
                'created_at' => '2023-02-19 02:32:21',
                'display_name' => 'Certifications',
                'id' => 28,
                'module_code' => 'law_firm-certifications',
                'sort_order' => 9,
                'type' => 'law_firm',
                'updated_at' => '2023-02-13 20:11:58',
            ),
            27 => 
            array (
                'created_at' => '2023-02-19 02:32:21',
                'display_name' => 'Broadcasts',
                'id' => 29,
                'module_code' => 'law_firm-broadcasts',
                'sort_order' => 9,
                'type' => 'law_firm',
                'updated_at' => '2023-02-13 20:11:58',
            ),
            28 => 
            array (
                'created_at' => '2023-03-14 23:52:59',
                'display_name' => 'List Education',
                'id' => 30,
                'module_code' => 'lawyer-education',
                'sort_order' => 7,
                'type' => 'lawyer',
                'updated_at' => '2023-02-13 20:11:58',
            ),
            29 => 
            array (
                'created_at' => '2023-02-18 21:32:21',
                'display_name' => 'Lawyer Experience',
                'id' => 31,
                'module_code' => 'lawyer-experience',
                'sort_order' => 9,
                'type' => 'lawyer',
                'updated_at' => '2023-02-13 20:11:58',
            ),
            30 => 
            array (
                'created_at' => '2023-02-19 02:32:21',
                'display_name' => 'Lawyer Services',
                'id' => 32,
                'module_code' => 'lawyer-services',
                'sort_order' => 9,
                'type' => 'lawyer',
                'updated_at' => '2023-02-13 20:11:58',
            ),
            31 => 
            array (
                'created_at' => '2023-02-19 02:32:21',
                'display_name' => 'LawFirm Services',
                'id' => 33,
                'module_code' => 'law_firm-services',
                'sort_order' => 9,
                'type' => 'law_firm',
                'updated_at' => '2023-02-13 20:11:58',
            ),
        ));
        
        
    }
}