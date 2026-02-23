<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RolePermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('role_permissions')->delete();
        
        \DB::table('role_permissions')->insert(array (
            0 => 
            array (
                'created_at' => '2024-02-22 16:47:43',
                'display_group' => 'Lawyer',
                'display_name' => 'Lawyer Index',
                'id' => 1,
                'permission_code' => 'lawyer.index',
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'created_at' => '2024-02-22 16:47:43',
                'display_group' => 'Lawyer',
                'display_name' => 'Add Lawyer',
                'id' => 2,
                'permission_code' => 'lawyer.add',
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'created_at' => '2024-02-22 16:47:43',
                'display_group' => 'Lawyer',
                'display_name' => 'Edit Lawyer',
                'id' => 3,
                'permission_code' => 'lawyer.edit',
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'created_at' => '2024-02-22 16:47:43',
                'display_group' => 'Lawyer',
                'display_name' => 'Delete Lawyer',
                'id' => 4,
                'permission_code' => 'lawyer.delete',
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'created_at' => '2024-02-22 16:47:43',
                'display_group' => 'Lawyer',
                'display_name' => 'Show Lawyer',
                'id' => 5,
                'permission_code' => 'lawyer.show',
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'created_at' => '2024-02-22 16:47:43',
                'display_group' => 'Lawyer',
                'display_name' => 'Approve Lawyer',
                'id' => 6,
                'permission_code' => 'lawyer.approve',
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'created_at' => '2024-02-22 16:47:43',
                'display_group' => 'Lawyer',
                'display_name' => 'Import Lawyer',
                'id' => 7,
                'permission_code' => 'lawyer.import',
                'updated_at' => NULL,
            ),
            7 => 
            array (
                'created_at' => '2024-02-22 16:47:43',
                'display_group' => 'Lawyer',
                'display_name' => 'Export Lawyer',
                'id' => 8,
                'permission_code' => 'lawyer.export',
                'updated_at' => NULL,
            ),
            8 => 
            array (
                'created_at' => '2024-02-22 16:47:43',
                'display_group' => 'Lawyer',
                'display_name' => 'Add Lawyer Education',
                'id' => 9,
                'permission_code' => 'lawyer.add_education',
                'updated_at' => NULL,
            ),
            9 => 
            array (
                'created_at' => '2024-02-22 16:47:43',
                'display_group' => 'Lawyer',
                'display_name' => 'Add Lawyer Certification',
                'id' => 10,
                'permission_code' => 'lawyer.add_certification',
                'updated_at' => NULL,
            ),
            10 => 
            array (
                'created_at' => '2024-02-22 16:47:43',
                'display_group' => 'Lawyer',
                'display_name' => 'Add Lawyer Experience',
                'id' => 11,
                'permission_code' => 'lawyer.add_experience',
                'updated_at' => NULL,
            ),
            11 => 
            array (
                'created_at' => '2024-02-22 16:47:43',
                'display_group' => 'Lawyer',
                'display_name' => 'Add Lawyer Blog',
                'id' => 12,
                'permission_code' => 'lawyer.add_blog',
                'updated_at' => NULL,
            ),
            12 => 
            array (
                'created_at' => '2024-02-22 16:47:43',
                'display_group' => 'Lawyer',
                'display_name' => 'Add Lawyer Event',
                'id' => 13,
                'permission_code' => 'lawyer.add_event',
                'updated_at' => NULL,
            ),
            13 => 
            array (
                'created_at' => '2024-02-22 16:47:43',
                'display_group' => 'Lawyer',
                'display_name' => 'Add Lawyer Archive',
                'id' => 14,
                'permission_code' => 'lawyer.add_archive',
                'updated_at' => NULL,
            ),
            14 => 
            array (
                'created_at' => '2024-02-22 16:47:43',
                'display_group' => 'Lawyer',
                'display_name' => 'Add Lawyer Podcast',
                'id' => 15,
                'permission_code' => 'lawyer.add_podcast',
                'updated_at' => NULL,
            ),
            15 => 
            array (
                'created_at' => '2024-02-22 16:47:43',
                'display_group' => 'Lawyer',
                'display_name' => 'Add Lawyer Media',
                'id' => 16,
                'permission_code' => 'lawyer.add_media',
                'updated_at' => NULL,
            ),
            16 => 
            array (
                'created_at' => '2024-02-22 16:54:49',
                'display_group' => 'Lawyer Main Categories',
                'display_name' => 'Lawyer Main Category Index',
                'id' => 17,
                'permission_code' => 'lawyer_main_category.index',
                'updated_at' => NULL,
            ),
            17 => 
            array (
                'created_at' => '2024-02-22 16:54:49',
                'display_group' => 'Lawyer Main Categories',
                'display_name' => 'Add Lawyer Main Category',
                'id' => 18,
                'permission_code' => 'lawyer_main_category.add',
                'updated_at' => NULL,
            ),
            18 => 
            array (
                'created_at' => '2024-02-22 16:54:49',
                'display_group' => 'Lawyer Main Categories',
                'display_name' => 'Edit Lawyer Main Category',
                'id' => 19,
                'permission_code' => 'lawyer_main_category.edit',
                'updated_at' => NULL,
            ),
            19 => 
            array (
                'created_at' => '2024-02-22 16:54:49',
                'display_group' => 'Lawyer Main Categories',
                'display_name' => 'Delete Lawyer Main Category',
                'id' => 20,
                'permission_code' => 'lawyer_main_category.delete',
                'updated_at' => NULL,
            ),
            20 => 
            array (
                'created_at' => '2024-02-22 16:54:49',
                'display_group' => 'Lawyer Main Categories',
                'display_name' => 'Show Lawyer Main Category',
                'id' => 21,
                'permission_code' => 'lawyer_main_category.show',
                'updated_at' => NULL,
            ),
            21 => 
            array (
                'created_at' => '2024-02-22 16:54:49',
                'display_group' => 'Lawyer Main Categories',
                'display_name' => 'Import Lawyer Main Category',
                'id' => 22,
                'permission_code' => 'lawyer_main_category.import',
                'updated_at' => NULL,
            ),
            22 => 
            array (
                'created_at' => '2024-02-22 16:54:49',
                'display_group' => 'Lawyer Main Categories',
                'display_name' => 'Export Lawyer Main Category',
                'id' => 23,
                'permission_code' => 'lawyer_main_category.export',
                'updated_at' => NULL,
            ),
            23 => 
            array (
                'created_at' => '2024-02-22 16:57:11',
                'display_group' => 'Lawyer Categories',
                'display_name' => 'Lawyer Category Index',
                'id' => 24,
                'permission_code' => 'lawyer_category.index',
                'updated_at' => NULL,
            ),
            24 => 
            array (
                'created_at' => '2024-02-22 16:57:11',
                'display_group' => 'Lawyer Categories',
                'display_name' => 'Add Lawyer Category',
                'id' => 25,
                'permission_code' => 'lawyer_category.add',
                'updated_at' => NULL,
            ),
            25 => 
            array (
                'created_at' => '2024-02-22 16:57:11',
                'display_group' => 'Lawyer Categories',
                'display_name' => 'Edit Lawyer Category',
                'id' => 26,
                'permission_code' => 'lawyer_category.edit',
                'updated_at' => NULL,
            ),
            26 => 
            array (
                'created_at' => '2024-02-22 16:57:11',
                'display_group' => 'Lawyer Categories',
                'display_name' => 'Delete Lawyer Category',
                'id' => 27,
                'permission_code' => 'lawyer_category.delete',
                'updated_at' => NULL,
            ),
            27 => 
            array (
                'created_at' => '2024-02-22 16:57:11',
                'display_group' => 'Lawyer Categories',
                'display_name' => 'Show Lawyer Category',
                'id' => 28,
                'permission_code' => 'lawyer_category.show',
                'updated_at' => NULL,
            ),
            28 => 
            array (
                'created_at' => '2024-02-22 16:57:11',
                'display_group' => 'Lawyer Categories',
                'display_name' => 'Import Lawyer Category',
                'id' => 29,
                'permission_code' => 'lawyer_category.import',
                'updated_at' => NULL,
            ),
            29 => 
            array (
                'created_at' => '2024-02-22 16:57:11',
                'display_group' => 'Lawyer Categories',
                'display_name' => 'Export Lawyer Category',
                'id' => 30,
                'permission_code' => 'lawyer_category.export',
                'updated_at' => NULL,
            ),
            30 => 
            array (
                'created_at' => '2024-02-22 16:59:18',
                'display_group' => 'Law Firm',
                'display_name' => 'Law Firm Index',
                'id' => 31,
                'permission_code' => 'law_firm.index',
                'updated_at' => NULL,
            ),
            31 => 
            array (
                'created_at' => '2024-02-22 16:59:18',
                'display_group' => 'Law Firm',
                'display_name' => 'Add Law Firm',
                'id' => 32,
                'permission_code' => 'law_firm.add',
                'updated_at' => NULL,
            ),
            32 => 
            array (
                'created_at' => '2024-02-22 16:59:18',
                'display_group' => 'Law Firm',
                'display_name' => 'Edit Law Firm',
                'id' => 33,
                'permission_code' => 'law_firm.edit',
                'updated_at' => NULL,
            ),
            33 => 
            array (
                'created_at' => '2024-02-22 16:59:18',
                'display_group' => 'Law Firm',
                'display_name' => 'Delete Law Firm',
                'id' => 34,
                'permission_code' => 'law_firm.delete',
                'updated_at' => NULL,
            ),
            34 => 
            array (
                'created_at' => '2024-02-22 16:59:18',
                'display_group' => 'Law Firm',
                'display_name' => 'Show Law Firm',
                'id' => 35,
                'permission_code' => 'law_firm.show',
                'updated_at' => NULL,
            ),
            35 => 
            array (
                'created_at' => '2024-02-22 16:59:18',
                'display_group' => 'Law Firm',
                'display_name' => 'Approve Law Firm',
                'id' => 36,
                'permission_code' => 'law_firm.approve',
                'updated_at' => NULL,
            ),
            36 => 
            array (
                'created_at' => '2024-02-22 16:59:18',
                'display_group' => 'Law Firm',
                'display_name' => 'Import Law Firm',
                'id' => 37,
                'permission_code' => 'law_firm.import',
                'updated_at' => NULL,
            ),
            37 => 
            array (
                'created_at' => '2024-02-22 16:59:18',
                'display_group' => 'Law Firm',
                'display_name' => 'Export Law Firm',
                'id' => 38,
                'permission_code' => 'law_firm.export',
                'updated_at' => NULL,
            ),
            38 => 
            array (
                'created_at' => '2024-02-22 16:59:18',
                'display_group' => 'Law Firm',
                'display_name' => 'Add Law Firm Certification',
                'id' => 40,
                'permission_code' => 'law_firm.add_certification',
                'updated_at' => NULL,
            ),
            39 => 
            array (
                'created_at' => '2024-02-22 16:59:18',
                'display_group' => 'Law Firm',
                'display_name' => 'Add Law Firm Blog',
                'id' => 42,
                'permission_code' => 'law_firm.add_blog',
                'updated_at' => NULL,
            ),
            40 => 
            array (
                'created_at' => '2024-02-22 16:59:18',
                'display_group' => 'Law Firm',
                'display_name' => 'Add Law Firm Event',
                'id' => 43,
                'permission_code' => 'law_firm.add_event',
                'updated_at' => NULL,
            ),
            41 => 
            array (
                'created_at' => '2024-02-22 16:59:18',
                'display_group' => 'Law Firm',
                'display_name' => 'Add Law Firm Archive',
                'id' => 44,
                'permission_code' => 'law_firm.add_archive',
                'updated_at' => NULL,
            ),
            42 => 
            array (
                'created_at' => '2024-02-22 16:59:18',
                'display_group' => 'Law Firm',
                'display_name' => 'Add Law Firm Podcast',
                'id' => 45,
                'permission_code' => 'law_firm.add_podcast',
                'updated_at' => NULL,
            ),
            43 => 
            array (
                'created_at' => '2024-02-22 16:59:18',
                'display_group' => 'Law Firm',
                'display_name' => 'Add Law Firm Media',
                'id' => 46,
                'permission_code' => 'law_firm.add_media',
                'updated_at' => NULL,
            ),
            44 => 
            array (
                'created_at' => '2024-02-22 17:01:31',
                'display_group' => 'Law Firm Main Categories',
                'display_name' => 'Law Firm Main Category Index',
                'id' => 47,
                'permission_code' => 'law_firm_main_category.index',
                'updated_at' => NULL,
            ),
            45 => 
            array (
                'created_at' => '2024-02-22 17:01:31',
                'display_group' => 'Law Firm Main Categories',
                'display_name' => 'Add Law Firm Main Category',
                'id' => 48,
                'permission_code' => 'law_firm_main_category.add',
                'updated_at' => NULL,
            ),
            46 => 
            array (
                'created_at' => '2024-02-22 17:01:31',
                'display_group' => 'Law Firm Main Categories',
                'display_name' => 'Edit Law Firm Main Category',
                'id' => 49,
                'permission_code' => 'law_firm_main_category.edit',
                'updated_at' => NULL,
            ),
            47 => 
            array (
                'created_at' => '2024-02-22 17:01:31',
                'display_group' => 'Law Firm Main Categories',
                'display_name' => 'Delete Law Firm Main Category',
                'id' => 50,
                'permission_code' => 'law_firm_main_category.delete',
                'updated_at' => NULL,
            ),
            48 => 
            array (
                'created_at' => '2024-02-22 17:01:31',
                'display_group' => 'Law Firm Main Categories',
                'display_name' => 'Show Law Firm Main Category',
                'id' => 51,
                'permission_code' => 'law_firm_main_category.show',
                'updated_at' => NULL,
            ),
            49 => 
            array (
                'created_at' => '2024-02-22 17:01:31',
                'display_group' => 'Law Firm Main Categories',
                'display_name' => 'Import Law Firm Main Category',
                'id' => 52,
                'permission_code' => 'law_firm_main_category.import',
                'updated_at' => NULL,
            ),
            50 => 
            array (
                'created_at' => '2024-02-22 17:01:31',
                'display_group' => 'Law Firm Main Categories',
                'display_name' => 'Export Law Firm Main Category',
                'id' => 53,
                'permission_code' => 'law_firm_main_category.export',
                'updated_at' => NULL,
            ),
            51 => 
            array (
                'created_at' => '2024-02-22 17:02:51',
                'display_group' => 'Law Firm Categories',
                'display_name' => 'Law Firm Category Index',
                'id' => 54,
                'permission_code' => 'law_firm_category.index',
                'updated_at' => NULL,
            ),
            52 => 
            array (
                'created_at' => '2024-02-22 17:02:51',
                'display_group' => 'Law Firm Categories',
                'display_name' => 'Add Law Firm Category',
                'id' => 55,
                'permission_code' => 'law_firm_category.add',
                'updated_at' => NULL,
            ),
            53 => 
            array (
                'created_at' => '2024-02-22 17:02:51',
                'display_group' => 'Law Firm Categories',
                'display_name' => 'Edit Law Firm Category',
                'id' => 56,
                'permission_code' => 'law_firm_category.edit',
                'updated_at' => NULL,
            ),
            54 => 
            array (
                'created_at' => '2024-02-22 17:02:51',
                'display_group' => 'Law Firm Categories',
                'display_name' => 'Delete Law Firm Category',
                'id' => 57,
                'permission_code' => 'law_firm_category.delete',
                'updated_at' => NULL,
            ),
            55 => 
            array (
                'created_at' => '2024-02-22 17:02:51',
                'display_group' => 'Law Firm Categories',
                'display_name' => 'Show Law Firm Category',
                'id' => 58,
                'permission_code' => 'law_firm_category.show',
                'updated_at' => NULL,
            ),
            56 => 
            array (
                'created_at' => '2024-02-22 17:02:51',
                'display_group' => 'Law Firm Categories',
                'display_name' => 'Import Law Firm Category',
                'id' => 59,
                'permission_code' => 'law_firm_category.import',
                'updated_at' => NULL,
            ),
            57 => 
            array (
                'created_at' => '2024-02-22 17:02:51',
                'display_group' => 'Law Firm Categories',
                'display_name' => 'Export Law Firm Category',
                'id' => 60,
                'permission_code' => 'law_firm_category.export',
                'updated_at' => NULL,
            ),
            58 => 
            array (
                'created_at' => '2024-02-22 17:05:49',
                'display_group' => 'Customer',
                'display_name' => 'Customer Index',
                'id' => 61,
                'permission_code' => 'customer.index',
                'updated_at' => NULL,
            ),
            59 => 
            array (
                'created_at' => '2024-02-22 17:05:49',
                'display_group' => 'Customer',
                'display_name' => 'Add Customer',
                'id' => 62,
                'permission_code' => 'customer.add',
                'updated_at' => NULL,
            ),
            60 => 
            array (
                'created_at' => '2024-02-22 17:05:49',
                'display_group' => 'Customer',
                'display_name' => 'Edit Customer',
                'id' => 63,
                'permission_code' => 'customer.edit',
                'updated_at' => NULL,
            ),
            61 => 
            array (
                'created_at' => '2024-02-22 17:05:49',
                'display_group' => 'Customer',
                'display_name' => 'Delete Customer',
                'id' => 64,
                'permission_code' => 'customer.delete',
                'updated_at' => NULL,
            ),
            62 => 
            array (
                'created_at' => '2024-02-22 17:05:49',
                'display_group' => 'Customer',
                'display_name' => 'Show Customer',
                'id' => 65,
                'permission_code' => 'customer.show',
                'updated_at' => NULL,
            ),
            63 => 
            array (
                'created_at' => '2024-02-22 17:15:36',
                'display_group' => 'Event',
                'display_name' => 'Event Index',
                'id' => 66,
                'permission_code' => 'event.index',
                'updated_at' => NULL,
            ),
            64 => 
            array (
                'created_at' => '2024-02-22 17:15:36',
                'display_group' => 'Event',
                'display_name' => 'Add Event',
                'id' => 67,
                'permission_code' => 'event.add',
                'updated_at' => NULL,
            ),
            65 => 
            array (
                'created_at' => '2024-02-22 17:15:36',
                'display_group' => 'Event',
                'display_name' => 'Edit Event',
                'id' => 68,
                'permission_code' => 'event.edit',
                'updated_at' => NULL,
            ),
            66 => 
            array (
                'created_at' => '2024-02-22 17:15:36',
                'display_group' => 'Event',
                'display_name' => 'Delete Event',
                'id' => 69,
                'permission_code' => 'event.delete',
                'updated_at' => NULL,
            ),
            67 => 
            array (
                'created_at' => '2024-02-22 17:15:36',
                'display_group' => 'Event',
                'display_name' => 'Show Event',
                'id' => 70,
                'permission_code' => 'event.show',
                'updated_at' => NULL,
            ),
            68 => 
            array (
                'created_at' => '2024-02-22 17:15:36',
                'display_group' => 'Event',
                'display_name' => 'Approve Event',
                'id' => 71,
                'permission_code' => 'event.approve',
                'updated_at' => NULL,
            ),
            69 => 
            array (
                'created_at' => '2024-02-22 17:17:10',
                'display_group' => 'Event Category',
                'display_name' => 'Event Category Index',
                'id' => 72,
                'permission_code' => 'event_category.index',
                'updated_at' => NULL,
            ),
            70 => 
            array (
                'created_at' => '2024-02-22 17:17:10',
                'display_group' => 'Event Category',
                'display_name' => 'Add Event Category',
                'id' => 73,
                'permission_code' => 'event_category.add',
                'updated_at' => NULL,
            ),
            71 => 
            array (
                'created_at' => '2024-02-22 17:17:10',
                'display_group' => 'Event Category',
                'display_name' => 'Edit Event Category',
                'id' => 74,
                'permission_code' => 'event_category.edit',
                'updated_at' => NULL,
            ),
            72 => 
            array (
                'created_at' => '2024-02-22 17:17:10',
                'display_group' => 'Event Category',
                'display_name' => 'Delete Event Category',
                'id' => 75,
                'permission_code' => 'event_category.delete',
                'updated_at' => NULL,
            ),
            73 => 
            array (
                'created_at' => '2024-02-22 17:17:10',
                'display_group' => 'Event Category',
                'display_name' => 'Show Event Category',
                'id' => 76,
                'permission_code' => 'event_category.show',
                'updated_at' => NULL,
            ),
            74 => 
            array (
                'created_at' => '2024-02-22 17:18:41',
                'display_group' => 'Booked Appointments',
                'display_name' => 'Booked Appointments Index',
                'id' => 77,
                'permission_code' => 'booked_appointements.index',
                'updated_at' => NULL,
            ),
            75 => 
            array (
                'created_at' => '2024-02-22 17:18:41',
                'display_group' => 'Booked Appointments',
                'display_name' => 'Show Booked Appointments',
                'id' => 78,
                'permission_code' => 'booked_appointements.show',
                'updated_at' => NULL,
            ),
            76 => 
            array (
                'created_at' => '2024-02-22 17:19:21',
                'display_group' => 'Podcast',
                'display_name' => 'Podcast Index',
                'id' => 79,
                'permission_code' => 'podcast.index',
                'updated_at' => NULL,
            ),
            77 => 
            array (
                'created_at' => '2024-02-22 17:19:21',
                'display_group' => 'Podcast',
                'display_name' => 'Add Podcast',
                'id' => 80,
                'permission_code' => 'podcast.add',
                'updated_at' => NULL,
            ),
            78 => 
            array (
                'created_at' => '2024-02-22 17:19:21',
                'display_group' => 'Podcast',
                'display_name' => 'Edit Podcast',
                'id' => 81,
                'permission_code' => 'podcast.edit',
                'updated_at' => NULL,
            ),
            79 => 
            array (
                'created_at' => '2024-02-22 17:19:21',
                'display_group' => 'Podcast',
                'display_name' => 'Delete Podcast',
                'id' => 82,
                'permission_code' => 'podcast.delete',
                'updated_at' => NULL,
            ),
            80 => 
            array (
                'created_at' => '2024-02-22 17:20:02',
                'display_group' => 'Podcast',
                'display_name' => 'Show Podcast',
                'id' => 83,
                'permission_code' => 'podcast.show',
                'updated_at' => NULL,
            ),
            81 => 
            array (
                'created_at' => '2024-02-22 17:20:59',
                'display_group' => 'Podcast Category',
                'display_name' => 'Podcast Category Index',
                'id' => 84,
                'permission_code' => 'podcast_category.index',
                'updated_at' => NULL,
            ),
            82 => 
            array (
                'created_at' => '2024-02-22 17:20:59',
                'display_group' => 'Podcast Category',
                'display_name' => 'Add Podcast Category',
                'id' => 85,
                'permission_code' => 'podcast_category.add',
                'updated_at' => NULL,
            ),
            83 => 
            array (
                'created_at' => '2024-02-22 17:20:59',
                'display_group' => 'Podcast Category',
                'display_name' => 'Edit Podcast Category',
                'id' => 86,
                'permission_code' => 'podcast_category.edit',
                'updated_at' => NULL,
            ),
            84 => 
            array (
                'created_at' => '2024-02-22 17:20:59',
                'display_group' => 'Podcast Category',
                'display_name' => 'Delete Podcast Category',
                'id' => 87,
                'permission_code' => 'podcast_category.delete',
                'updated_at' => NULL,
            ),
            85 => 
            array (
                'created_at' => '2024-02-22 17:20:59',
                'display_group' => 'Podcast Category',
                'display_name' => 'Show Podcast Category',
                'id' => 88,
                'permission_code' => 'podcast_category.show',
                'updated_at' => NULL,
            ),
            86 => 
            array (
                'created_at' => '2024-02-22 17:21:33',
                'display_group' => 'Media',
                'display_name' => 'Media Index',
                'id' => 89,
                'permission_code' => 'media.index',
                'updated_at' => NULL,
            ),
            87 => 
            array (
                'created_at' => '2024-02-22 17:21:33',
                'display_group' => 'Media',
                'display_name' => 'Add Media',
                'id' => 90,
                'permission_code' => 'media.add',
                'updated_at' => NULL,
            ),
            88 => 
            array (
                'created_at' => '2024-02-22 17:21:33',
                'display_group' => 'Media',
                'display_name' => 'Edit Media',
                'id' => 91,
                'permission_code' => 'media.edit',
                'updated_at' => NULL,
            ),
            89 => 
            array (
                'created_at' => '2024-02-22 17:21:33',
                'display_group' => 'Media',
                'display_name' => 'Delete Media',
                'id' => 92,
                'permission_code' => 'media.delete',
                'updated_at' => NULL,
            ),
            90 => 
            array (
                'created_at' => '2024-02-22 17:21:33',
                'display_group' => 'Media',
                'display_name' => 'Show Media',
                'id' => 93,
                'permission_code' => 'media.show',
                'updated_at' => NULL,
            ),
            91 => 
            array (
                'created_at' => '2024-02-22 17:22:09',
                'display_group' => 'Media Category',
                'display_name' => 'Media Category Index',
                'id' => 94,
                'permission_code' => 'media_category.index',
                'updated_at' => NULL,
            ),
            92 => 
            array (
                'created_at' => '2024-02-22 17:22:09',
                'display_group' => 'Media Category',
                'display_name' => 'Media Category Index',
                'id' => 95,
                'permission_code' => 'media_category.index',
                'updated_at' => NULL,
            ),
            93 => 
            array (
                'created_at' => '2024-02-22 17:22:09',
                'display_group' => 'Media Category',
                'display_name' => 'Add Media Category',
                'id' => 96,
                'permission_code' => 'media_category.add',
                'updated_at' => NULL,
            ),
            94 => 
            array (
                'created_at' => '2024-02-22 17:22:09',
                'display_group' => 'Media Category',
                'display_name' => 'Add Media Category',
                'id' => 97,
                'permission_code' => 'media_category.add',
                'updated_at' => NULL,
            ),
            95 => 
            array (
                'created_at' => '2024-02-22 17:22:09',
                'display_group' => 'Media Category',
                'display_name' => 'Edit Media Category',
                'id' => 98,
                'permission_code' => 'media_category.edit',
                'updated_at' => NULL,
            ),
            96 => 
            array (
                'created_at' => '2024-02-22 17:22:09',
                'display_group' => 'Media Category',
                'display_name' => 'Edit Media Category',
                'id' => 99,
                'permission_code' => 'media_category.edit',
                'updated_at' => NULL,
            ),
            97 => 
            array (
                'created_at' => '2024-02-22 17:22:09',
                'display_group' => 'Media Category',
                'display_name' => 'Delete Media Category',
                'id' => 100,
                'permission_code' => 'media_category.delete',
                'updated_at' => NULL,
            ),
            98 => 
            array (
                'created_at' => '2024-02-22 17:22:09',
                'display_group' => 'Media Category',
                'display_name' => 'Delete Media Category',
                'id' => 101,
                'permission_code' => 'media_category.delete',
                'updated_at' => NULL,
            ),
            99 => 
            array (
                'created_at' => '2024-02-22 17:22:09',
                'display_group' => 'Media Category',
                'display_name' => 'Show Media Category',
                'id' => 102,
                'permission_code' => 'media_category.show',
                'updated_at' => NULL,
            ),
        ));
        \DB::table('role_permissions')->insert(array (
            0 => 
            array (
                'created_at' => '2024-02-22 17:22:09',
                'display_group' => 'Media Category',
                'display_name' => 'Show Media Category',
                'id' => 103,
                'permission_code' => 'media_category.show',
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'created_at' => '2024-02-22 17:24:37',
                'display_group' => 'FAQ',
                'display_name' => 'FAQ Index',
                'id' => 104,
                'permission_code' => 'faq.index',
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'created_at' => '2024-02-22 17:24:37',
                'display_group' => 'FAQ',
                'display_name' => 'Add FAQ',
                'id' => 105,
                'permission_code' => 'faq.add',
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'created_at' => '2024-02-22 17:24:37',
                'display_group' => 'FAQ',
                'display_name' => 'Edit FAQ',
                'id' => 106,
                'permission_code' => 'faq.edit',
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'created_at' => '2024-02-22 17:24:37',
                'display_group' => 'FAQ',
                'display_name' => 'Delete FAQ',
                'id' => 107,
                'permission_code' => 'faq.delete',
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'created_at' => '2024-02-22 17:24:37',
                'display_group' => 'FAQ',
                'display_name' => 'Show FAQ',
                'id' => 108,
                'permission_code' => 'faq.show',
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'created_at' => '2024-02-22 17:24:37',
                'display_group' => 'FAQ',
                'display_name' => 'Import FAQ',
                'id' => 109,
                'permission_code' => 'faq.import',
                'updated_at' => NULL,
            ),
            7 => 
            array (
                'created_at' => '2024-02-22 17:24:37',
                'display_group' => 'FAQ',
                'display_name' => 'Export FAQ',
                'id' => 110,
                'permission_code' => 'faq.export',
                'updated_at' => NULL,
            ),
            8 => 
            array (
                'created_at' => '2024-02-22 17:26:10',
                'display_group' => 'FAQ Category',
                'display_name' => 'FAQ Category Index',
                'id' => 111,
                'permission_code' => 'faq_category.index',
                'updated_at' => NULL,
            ),
            9 => 
            array (
                'created_at' => '2024-02-22 17:26:10',
                'display_group' => 'FAQ Category',
                'display_name' => 'Add FAQ Category',
                'id' => 112,
                'permission_code' => 'faq_category.add',
                'updated_at' => NULL,
            ),
            10 => 
            array (
                'created_at' => '2024-02-22 17:26:10',
                'display_group' => 'FAQ Category',
                'display_name' => 'Edit FAQ Category',
                'id' => 113,
                'permission_code' => 'faq_category.edit',
                'updated_at' => NULL,
            ),
            11 => 
            array (
                'created_at' => '2024-02-22 17:26:10',
                'display_group' => 'FAQ Category',
                'display_name' => 'Delete FAQ Category',
                'id' => 114,
                'permission_code' => 'faq_category.delete',
                'updated_at' => NULL,
            ),
            12 => 
            array (
                'created_at' => '2024-02-22 17:26:10',
                'display_group' => 'FAQ Category',
                'display_name' => 'Show FAQ Category',
                'id' => 115,
                'permission_code' => 'faq_category.show',
                'updated_at' => NULL,
            ),
            13 => 
            array (
                'created_at' => '2024-02-22 17:26:10',
                'display_group' => 'FAQ Category',
                'display_name' => 'Import FAQ Category',
                'id' => 116,
                'permission_code' => 'faq_category.import',
                'updated_at' => NULL,
            ),
            14 => 
            array (
                'created_at' => '2024-02-22 17:26:10',
                'display_group' => 'FAQ Category',
                'display_name' => 'Export FAQ Category',
                'id' => 117,
                'permission_code' => 'faq_category.export',
                'updated_at' => NULL,
            ),
            15 => 
            array (
                'created_at' => '2024-02-22 17:55:46',
                'display_group' => 'Contact Us',
                'display_name' => 'Contact Index',
                'id' => 118,
                'permission_code' => 'contact.index',
                'updated_at' => NULL,
            ),
            16 => 
            array (
                'created_at' => '2024-02-22 17:55:46',
                'display_group' => 'Contact Us',
                'display_name' => 'Show Contact',
                'id' => 119,
                'permission_code' => 'contact.show',
                'updated_at' => NULL,
            ),
            17 => 
            array (
                'created_at' => '2024-02-22 17:56:58',
                'display_group' => 'Gateway',
                'display_name' => 'Gateway Index',
                'id' => 120,
                'permission_code' => 'gateway.index',
                'updated_at' => NULL,
            ),
            18 => 
            array (
                'created_at' => '2024-02-22 17:56:58',
                'display_group' => 'Gateway',
                'display_name' => 'Edit Gateway',
                'id' => 121,
                'permission_code' => 'gateway.edit',
                'updated_at' => NULL,
            ),
            19 => 
            array (
                'created_at' => '2024-02-22 17:56:58',
                'display_group' => 'Gateway',
                'display_name' => 'Show Gateway',
                'id' => 122,
                'permission_code' => 'gateway.show',
                'updated_at' => NULL,
            ),
            20 => 
            array (
                'created_at' => '2024-02-22 17:59:23',
                'display_group' => 'Pricing Plan',
                'display_name' => 'Pricing Plan Index',
                'id' => 123,
                'permission_code' => 'pricing_plane.index',
                'updated_at' => NULL,
            ),
            21 => 
            array (
                'created_at' => '2024-02-22 17:59:23',
                'display_group' => 'Pricing Plan',
                'display_name' => 'Add Pricing Plan',
                'id' => 124,
                'permission_code' => 'pricing_plane.add',
                'updated_at' => NULL,
            ),
            22 => 
            array (
                'created_at' => '2024-02-22 17:59:23',
                'display_group' => 'Pricing Plan',
                'display_name' => 'Edit Pricing Plan',
                'id' => 125,
                'permission_code' => 'pricing_plane.edit',
                'updated_at' => NULL,
            ),
            23 => 
            array (
                'created_at' => '2024-02-22 17:59:23',
                'display_group' => 'Pricing Plan',
                'display_name' => 'Delete Pricing Plan',
                'id' => 126,
                'permission_code' => 'pricing_plane.delete',
                'updated_at' => NULL,
            ),
            24 => 
            array (
                'created_at' => '2024-02-22 17:59:23',
                'display_group' => 'Pricing Plan',
                'display_name' => 'Show Pricing Plan',
                'id' => 127,
                'permission_code' => 'pricing_plane.show',
                'updated_at' => NULL,
            ),
            25 => 
            array (
                'created_at' => '2024-02-22 17:59:23',
                'display_group' => 'Pricing Plan',
                'display_name' => 'Import Pricing Plan',
                'id' => 128,
                'permission_code' => 'pricing_plane.import',
                'updated_at' => NULL,
            ),
            26 => 
            array (
                'created_at' => '2024-02-22 17:59:23',
                'display_group' => 'Pricing Plan',
                'display_name' => 'Export Pricing Plan',
                'id' => 129,
                'permission_code' => 'pricing_plane.export',
                'updated_at' => NULL,
            ),
            27 => 
            array (
                'created_at' => '2024-02-22 17:59:59',
                'display_group' => 'Blog',
                'display_name' => 'Blog Index',
                'id' => 130,
                'permission_code' => 'blog.index',
                'updated_at' => NULL,
            ),
            28 => 
            array (
                'created_at' => '2024-02-22 17:59:59',
                'display_group' => 'Blog',
                'display_name' => 'Add Blog',
                'id' => 131,
                'permission_code' => 'blog.add',
                'updated_at' => NULL,
            ),
            29 => 
            array (
                'created_at' => '2024-02-22 17:59:59',
                'display_group' => 'Blog',
                'display_name' => 'Edit Blog',
                'id' => 132,
                'permission_code' => 'blog.edit',
                'updated_at' => NULL,
            ),
            30 => 
            array (
                'created_at' => '2024-02-22 17:59:59',
                'display_group' => 'Blog',
                'display_name' => 'Delete Blog',
                'id' => 133,
                'permission_code' => 'blog.delete',
                'updated_at' => NULL,
            ),
            31 => 
            array (
                'created_at' => '2024-02-22 17:59:59',
                'display_group' => 'Blog',
                'display_name' => 'Show Blog',
                'id' => 134,
                'permission_code' => 'blog.show',
                'updated_at' => NULL,
            ),
            32 => 
            array (
                'created_at' => '2024-02-22 18:00:53',
                'display_group' => 'Blog Category',
                'display_name' => 'Blog Category Index',
                'id' => 135,
                'permission_code' => 'blog_category.index',
                'updated_at' => NULL,
            ),
            33 => 
            array (
                'created_at' => '2024-02-22 18:00:53',
                'display_group' => 'Blog Category',
                'display_name' => 'Add Blog Category',
                'id' => 136,
                'permission_code' => 'blog_category.add',
                'updated_at' => NULL,
            ),
            34 => 
            array (
                'created_at' => '2024-02-22 18:00:53',
                'display_group' => 'Blog Category',
                'display_name' => 'Edit Blog Category',
                'id' => 137,
                'permission_code' => 'blog_category.edit',
                'updated_at' => NULL,
            ),
            35 => 
            array (
                'created_at' => '2024-02-22 18:00:53',
                'display_group' => 'Blog Category',
                'display_name' => 'Delete Blog Category',
                'id' => 138,
                'permission_code' => 'blog_category.delete',
                'updated_at' => NULL,
            ),
            36 => 
            array (
                'created_at' => '2024-02-22 18:00:53',
                'display_group' => 'Blog Category',
                'display_name' => 'Show Blog Category',
                'id' => 139,
                'permission_code' => 'blog_category.show',
                'updated_at' => NULL,
            ),
            37 => 
            array (
                'created_at' => '2024-02-22 18:02:01',
                'display_group' => 'Cource',
                'display_name' => 'Cource Index',
                'id' => 140,
                'permission_code' => 'cource.index',
                'updated_at' => NULL,
            ),
            38 => 
            array (
                'created_at' => '2024-02-22 18:02:01',
                'display_group' => 'Cource',
                'display_name' => 'Add Cource',
                'id' => 141,
                'permission_code' => 'cource.add',
                'updated_at' => NULL,
            ),
            39 => 
            array (
                'created_at' => '2024-02-22 18:02:01',
                'display_group' => 'Cource',
                'display_name' => 'Edit Cource',
                'id' => 142,
                'permission_code' => 'cource.edit',
                'updated_at' => NULL,
            ),
            40 => 
            array (
                'created_at' => '2024-02-22 18:02:02',
                'display_group' => 'Cource',
                'display_name' => 'Delete Cource',
                'id' => 143,
                'permission_code' => 'cource.delete',
                'updated_at' => NULL,
            ),
            41 => 
            array (
                'created_at' => '2024-02-22 18:02:02',
                'display_group' => 'Cource',
                'display_name' => 'Show Cource',
                'id' => 144,
                'permission_code' => 'cource.show',
                'updated_at' => NULL,
            ),
            42 => 
            array (
                'created_at' => '2024-02-22 18:02:59',
                'display_group' => 'Cource Category',
                'display_name' => 'Cource Category Index',
                'id' => 145,
                'permission_code' => 'cource_category.index',
                'updated_at' => NULL,
            ),
            43 => 
            array (
                'created_at' => '2024-02-22 18:03:00',
                'display_group' => 'Cource Category',
                'display_name' => 'Add Cource Category',
                'id' => 146,
                'permission_code' => 'cource_category.add',
                'updated_at' => NULL,
            ),
            44 => 
            array (
                'created_at' => '2024-02-22 18:03:00',
                'display_group' => 'Cource Category',
                'display_name' => 'Edit Cource Category',
                'id' => 147,
                'permission_code' => 'cource_category.edit',
                'updated_at' => NULL,
            ),
            45 => 
            array (
                'created_at' => '2024-02-22 18:03:00',
                'display_group' => 'Cource Category',
                'display_name' => 'Delete Cource Category',
                'id' => 148,
                'permission_code' => 'cource_category.delete',
                'updated_at' => NULL,
            ),
            46 => 
            array (
                'created_at' => '2024-02-22 18:03:00',
                'display_group' => 'Cource Category',
                'display_name' => 'Show Cource Category',
                'id' => 149,
                'permission_code' => 'cource_category.show',
                'updated_at' => NULL,
            ),
            47 => 
            array (
                'created_at' => '2024-02-22 18:03:47',
                'display_group' => 'Testimonial',
                'display_name' => 'Testimonial Index',
                'id' => 150,
                'permission_code' => 'testimonial.index',
                'updated_at' => NULL,
            ),
            48 => 
            array (
                'created_at' => '2024-02-22 18:03:47',
                'display_group' => 'Testimonial',
                'display_name' => 'Add Testimonial',
                'id' => 151,
                'permission_code' => 'testimonial.add',
                'updated_at' => NULL,
            ),
            49 => 
            array (
                'created_at' => '2024-02-22 18:03:47',
                'display_group' => 'Testimonial',
                'display_name' => 'Edit Testimonial',
                'id' => 152,
                'permission_code' => 'testimonial.edit',
                'updated_at' => NULL,
            ),
            50 => 
            array (
                'created_at' => '2024-02-22 18:03:47',
                'display_group' => 'Testimonial',
                'display_name' => 'Delete Testimonial',
                'id' => 153,
                'permission_code' => 'testimonial.delete',
                'updated_at' => NULL,
            ),
            51 => 
            array (
                'created_at' => '2024-02-22 18:03:47',
                'display_group' => 'Testimonial',
                'display_name' => 'Show Testimonial',
                'id' => 154,
                'permission_code' => 'testimonial.show',
                'updated_at' => NULL,
            ),
            52 => 
            array (
                'created_at' => '2024-02-22 18:03:47',
                'display_group' => 'Testimonial',
                'display_name' => 'Import Testimonial',
                'id' => 155,
                'permission_code' => 'testimonial.import',
                'updated_at' => NULL,
            ),
            53 => 
            array (
                'created_at' => '2024-02-22 18:03:47',
                'display_group' => 'Testimonial',
                'display_name' => 'Export Testimonial',
                'id' => 156,
                'permission_code' => 'testimonial.export',
                'updated_at' => NULL,
            ),
            54 => 
            array (
                'created_at' => '2024-02-22 18:04:33',
                'display_group' => 'Tag',
                'display_name' => 'Tag Index',
                'id' => 157,
                'permission_code' => 'tag.index',
                'updated_at' => NULL,
            ),
            55 => 
            array (
                'created_at' => '2024-02-22 18:04:33',
                'display_group' => 'Tag',
                'display_name' => 'Add Tag',
                'id' => 158,
                'permission_code' => 'tag.add',
                'updated_at' => NULL,
            ),
            56 => 
            array (
                'created_at' => '2024-02-22 18:04:33',
                'display_group' => 'Tag',
                'display_name' => 'Edit Tag',
                'id' => 159,
                'permission_code' => 'tag.edit',
                'updated_at' => NULL,
            ),
            57 => 
            array (
                'created_at' => '2024-02-22 18:04:33',
                'display_group' => 'Tag',
                'display_name' => 'Delete Tag',
                'id' => 160,
                'permission_code' => 'tag.delete',
                'updated_at' => NULL,
            ),
            58 => 
            array (
                'created_at' => '2024-02-22 18:04:33',
                'display_group' => 'Tag',
                'display_name' => 'Show Tag',
                'id' => 161,
                'permission_code' => 'tag.show',
                'updated_at' => NULL,
            ),
            59 => 
            array (
                'created_at' => '2024-02-22 18:04:33',
                'display_group' => 'Tag',
                'display_name' => 'Import Tag',
                'id' => 162,
                'permission_code' => 'tag.import',
                'updated_at' => NULL,
            ),
            60 => 
            array (
                'created_at' => '2024-02-22 18:04:33',
                'display_group' => 'Tag',
                'display_name' => 'Export Tag',
                'id' => 163,
                'permission_code' => 'tag.export',
                'updated_at' => NULL,
            ),
            61 => 
            array (
                'created_at' => '2024-02-22 18:05:30',
                'display_group' => 'Currency',
                'display_name' => 'Currency Index',
                'id' => 164,
                'permission_code' => 'currency.index',
                'updated_at' => NULL,
            ),
            62 => 
            array (
                'created_at' => '2024-02-22 18:05:30',
                'display_group' => 'Currency',
                'display_name' => 'Add Currency',
                'id' => 165,
                'permission_code' => 'currency.add',
                'updated_at' => NULL,
            ),
            63 => 
            array (
                'created_at' => '2024-02-22 18:05:30',
                'display_group' => 'Currency',
                'display_name' => 'Edit Currency',
                'id' => 166,
                'permission_code' => 'currency.edit',
                'updated_at' => NULL,
            ),
            64 => 
            array (
                'created_at' => '2024-02-22 18:05:30',
                'display_group' => 'Currency',
                'display_name' => 'Delete Currency',
                'id' => 167,
                'permission_code' => 'currency.delete',
                'updated_at' => NULL,
            ),
            65 => 
            array (
                'created_at' => '2024-02-22 18:05:30',
                'display_group' => 'Currency',
                'display_name' => 'Show Currency',
                'id' => 168,
                'permission_code' => 'currency.show',
                'updated_at' => NULL,
            ),
            66 => 
            array (
                'created_at' => '2024-02-22 18:06:49',
                'display_group' => 'Withdraw Request',
                'display_name' => 'Withdraw Request Index',
                'id' => 169,
                'permission_code' => 'withdraw_request.index',
                'updated_at' => NULL,
            ),
            67 => 
            array (
                'created_at' => '2024-02-22 18:06:49',
                'display_group' => 'Withdraw Request',
                'display_name' => 'Edit Withdraw Request',
                'id' => 170,
                'permission_code' => 'withdraw_request.edit',
                'updated_at' => NULL,
            ),
            68 => 
            array (
                'created_at' => '2024-02-22 18:06:49',
                'display_group' => 'Withdraw Request',
                'display_name' => 'Show Withdraw Request',
                'id' => 171,
                'permission_code' => 'withdraw_request.show',
                'updated_at' => NULL,
            ),
            69 => 
            array (
                'created_at' => '2024-02-22 18:38:45',
                'display_group' => 'Company Page',
                'display_name' => 'Company Page Index',
                'id' => 172,
                'permission_code' => 'company_page.index',
                'updated_at' => NULL,
            ),
            70 => 
            array (
                'created_at' => '2024-02-22 18:38:45',
                'display_group' => 'Company Page',
                'display_name' => 'Add Company Page',
                'id' => 173,
                'permission_code' => 'company_page.add',
                'updated_at' => NULL,
            ),
            71 => 
            array (
                'created_at' => '2024-02-22 18:38:45',
                'display_group' => 'Company Page',
                'display_name' => 'Edit Company Page',
                'id' => 174,
                'permission_code' => 'company_page.edit',
                'updated_at' => NULL,
            ),
            72 => 
            array (
                'created_at' => '2024-02-22 18:38:45',
                'display_group' => 'Company Page',
                'display_name' => 'Delete Company Page',
                'id' => 175,
                'permission_code' => 'company_page.delete',
                'updated_at' => NULL,
            ),
            73 => 
            array (
                'created_at' => '2024-02-22 18:38:45',
                'display_group' => 'Company Page',
                'display_name' => 'Show Company Page',
                'id' => 176,
                'permission_code' => 'company_page.show',
                'updated_at' => NULL,
            ),
            74 => 
            array (
                'created_at' => '2024-02-22 18:39:51',
                'display_group' => 'Site Content Index',
                'display_name' => 'Site Content Index',
                'id' => 177,
                'permission_code' => 'site_content.index',
                'updated_at' => NULL,
            ),
            75 => 
            array (
                'created_at' => '2024-02-22 18:40:45',
                'display_group' => 'Country',
                'display_name' => 'Country Index',
                'id' => 178,
                'permission_code' => 'country.index',
                'updated_at' => NULL,
            ),
            76 => 
            array (
                'created_at' => '2024-02-22 18:40:45',
                'display_group' => 'Country',
                'display_name' => 'Add Country',
                'id' => 179,
                'permission_code' => 'country.add',
                'updated_at' => NULL,
            ),
            77 => 
            array (
                'created_at' => '2024-02-22 18:40:45',
                'display_group' => 'Country',
                'display_name' => 'Edit Country',
                'id' => 180,
                'permission_code' => 'country.edit',
                'updated_at' => NULL,
            ),
            78 => 
            array (
                'created_at' => '2024-02-22 18:40:45',
                'display_group' => 'Country',
                'display_name' => 'Delete Country',
                'id' => 181,
                'permission_code' => 'country.delete',
                'updated_at' => NULL,
            ),
            79 => 
            array (
                'created_at' => '2024-02-22 18:40:45',
                'display_group' => 'Country',
                'display_name' => 'Show Country',
                'id' => 182,
                'permission_code' => 'country.show',
                'updated_at' => NULL,
            ),
            80 => 
            array (
                'created_at' => '2024-02-22 18:40:45',
                'display_group' => 'Country',
                'display_name' => 'Import Country',
                'id' => 183,
                'permission_code' => 'country.import',
                'updated_at' => NULL,
            ),
            81 => 
            array (
                'created_at' => '2024-02-22 18:40:45',
                'display_group' => 'Country',
                'display_name' => 'Export Country',
                'id' => 184,
                'permission_code' => 'country.export',
                'updated_at' => NULL,
            ),
            82 => 
            array (
                'created_at' => '2024-02-22 18:41:18',
                'display_group' => 'State',
                'display_name' => 'State Index',
                'id' => 185,
                'permission_code' => 'state.index',
                'updated_at' => NULL,
            ),
            83 => 
            array (
                'created_at' => '2024-02-22 18:41:18',
                'display_group' => 'State',
                'display_name' => 'Add State',
                'id' => 186,
                'permission_code' => 'state.add',
                'updated_at' => NULL,
            ),
            84 => 
            array (
                'created_at' => '2024-02-22 18:41:18',
                'display_group' => 'State',
                'display_name' => 'Edit State',
                'id' => 187,
                'permission_code' => 'state.edit',
                'updated_at' => NULL,
            ),
            85 => 
            array (
                'created_at' => '2024-02-22 18:41:18',
                'display_group' => 'State',
                'display_name' => 'Delete State',
                'id' => 188,
                'permission_code' => 'state.delete',
                'updated_at' => NULL,
            ),
            86 => 
            array (
                'created_at' => '2024-02-22 18:41:18',
                'display_group' => 'State',
                'display_name' => 'Show State',
                'id' => 189,
                'permission_code' => 'state.show',
                'updated_at' => NULL,
            ),
            87 => 
            array (
                'created_at' => '2024-02-22 18:41:18',
                'display_group' => 'State',
                'display_name' => 'Import State',
                'id' => 190,
                'permission_code' => 'state.import',
                'updated_at' => NULL,
            ),
            88 => 
            array (
                'created_at' => '2024-02-22 18:41:18',
                'display_group' => 'State',
                'display_name' => 'Export State',
                'id' => 191,
                'permission_code' => 'state.export',
                'updated_at' => NULL,
            ),
            89 => 
            array (
                'created_at' => '2024-02-22 18:41:47',
                'display_group' => 'City',
                'display_name' => 'City Index',
                'id' => 192,
                'permission_code' => 'city.index',
                'updated_at' => NULL,
            ),
            90 => 
            array (
                'created_at' => '2024-02-22 18:41:47',
                'display_group' => 'City',
                'display_name' => 'Add City',
                'id' => 193,
                'permission_code' => 'city.add',
                'updated_at' => NULL,
            ),
            91 => 
            array (
                'created_at' => '2024-02-22 18:41:47',
                'display_group' => 'City',
                'display_name' => 'Edit City',
                'id' => 194,
                'permission_code' => 'city.edit',
                'updated_at' => NULL,
            ),
            92 => 
            array (
                'created_at' => '2024-02-22 18:41:47',
                'display_group' => 'City',
                'display_name' => 'Delete City',
                'id' => 195,
                'permission_code' => 'city.delete',
                'updated_at' => NULL,
            ),
            93 => 
            array (
                'created_at' => '2024-02-22 18:41:47',
                'display_group' => 'City',
                'display_name' => 'Show City',
                'id' => 196,
                'permission_code' => 'city.show',
                'updated_at' => NULL,
            ),
            94 => 
            array (
                'created_at' => '2024-02-22 18:41:47',
                'display_group' => 'City',
                'display_name' => 'Import City',
                'id' => 197,
                'permission_code' => 'city.import',
                'updated_at' => NULL,
            ),
            95 => 
            array (
                'created_at' => '2024-02-22 18:41:47',
                'display_group' => 'City',
                'display_name' => 'Export City',
                'id' => 198,
                'permission_code' => 'city.export',
                'updated_at' => NULL,
            ),
            96 => 
            array (
                'created_at' => '2024-02-22 18:42:27',
                'display_group' => 'Language',
                'display_name' => 'Language Index',
                'id' => 199,
                'permission_code' => 'language.index',
                'updated_at' => NULL,
            ),
            97 => 
            array (
                'created_at' => '2024-02-22 18:42:27',
                'display_group' => 'Language',
                'display_name' => 'Add Language',
                'id' => 200,
                'permission_code' => 'language.add',
                'updated_at' => NULL,
            ),
            98 => 
            array (
                'created_at' => '2024-02-22 18:42:27',
                'display_group' => 'Language',
                'display_name' => 'Edit Language',
                'id' => 201,
                'permission_code' => 'language.edit',
                'updated_at' => NULL,
            ),
            99 => 
            array (
                'created_at' => '2024-02-22 18:42:27',
                'display_group' => 'Language',
                'display_name' => 'Delete Language',
                'id' => 202,
                'permission_code' => 'language.delete',
                'updated_at' => NULL,
            ),
        ));
        \DB::table('role_permissions')->insert(array (
            0 => 
            array (
                'created_at' => '2024-02-22 18:42:27',
                'display_group' => 'Language',
                'display_name' => 'Show Language',
                'id' => 203,
                'permission_code' => 'language.show',
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'created_at' => '2024-02-22 18:42:27',
                'display_group' => 'Language',
                'display_name' => 'Import Language',
                'id' => 204,
                'permission_code' => 'language.import',
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'created_at' => '2024-02-22 18:42:27',
                'display_group' => 'Language',
                'display_name' => 'Export Language',
                'id' => 205,
                'permission_code' => 'language.export',
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'created_at' => '2024-02-22 18:44:29',
                'display_group' => 'Role',
                'display_name' => 'Role Index',
                'id' => 206,
                'permission_code' => 'role.index',
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'created_at' => '2024-02-22 18:44:29',
                'display_group' => 'Role',
                'display_name' => 'Add Role',
                'id' => 207,
                'permission_code' => 'role.add',
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'created_at' => '2024-02-22 18:44:29',
                'display_group' => 'Role',
                'display_name' => 'Edit Role',
                'id' => 208,
                'permission_code' => 'role.edit',
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'created_at' => '2024-02-22 18:44:29',
                'display_group' => 'Role',
                'display_name' => 'Delete Role',
                'id' => 209,
                'permission_code' => 'role.delete',
                'updated_at' => NULL,
            ),
            7 => 
            array (
                'created_at' => '2024-02-22 18:44:29',
                'display_group' => 'Role',
                'display_name' => 'Show Role',
                'id' => 210,
                'permission_code' => 'role.show',
                'updated_at' => NULL,
            ),
            8 => 
            array (
                'created_at' => '2024-02-22 18:44:29',
                'display_group' => 'Role',
                'display_name' => 'Import Role',
                'id' => 211,
                'permission_code' => 'role.import',
                'updated_at' => NULL,
            ),
            9 => 
            array (
                'created_at' => '2024-02-22 18:44:29',
                'display_group' => 'Role',
                'display_name' => 'Export Role',
                'id' => 212,
                'permission_code' => 'role.export',
                'updated_at' => NULL,
            ),
            10 => 
            array (
                'created_at' => '2024-02-22 18:47:17',
                'display_group' => 'Setting',
                'display_name' => 'General Setting Index',
                'id' => 213,
                'permission_code' => 'general_setting.index',
                'updated_at' => NULL,
            ),
            11 => 
            array (
                'created_at' => '2024-02-22 18:47:17',
                'display_group' => 'Setting',
                'display_name' => 'Configurations Setting Index',
                'id' => 214,
                'permission_code' => 'configurations_setting.index',
                'updated_at' => NULL,
            ),
            12 => 
            array (
                'created_at' => '2024-02-22 18:47:17',
                'display_group' => 'Setting',
                'display_name' => 'Social Links Setting Index',
                'id' => 215,
                'permission_code' => 'social_links_setting.index',
                'updated_at' => NULL,
            ),
            13 => 
            array (
                'created_at' => '2024-02-22 18:47:17',
                'display_group' => 'Setting',
                'display_name' => 'Subscription Methods Setting Index',
                'id' => 216,
                'permission_code' => 'subscription_methods_etting.index',
                'updated_at' => NULL,
            ),
            14 => 
            array (
                'created_at' => '2024-02-22 18:47:17',
                'display_group' => 'Setting',
                'display_name' => 'Commission Index',
                'id' => 217,
                'permission_code' => 'commission.index',
                'updated_at' => NULL,
            ),
            15 => 
            array (
                'created_at' => '2024-02-22 18:47:17',
                'display_group' => 'User',
                'display_name' => 'Users Index',
                'id' => 218,
                'permission_code' => 'users.index',
                'updated_at' => NULL,
            ),
            16 => 
            array (
                'created_at' => '2024-02-22 18:47:17',
                'display_group' => 'User',
                'display_name' => 'Add Users',
                'id' => 219,
                'permission_code' => 'users.add',
                'updated_at' => NULL,
            ),
            17 => 
            array (
                'created_at' => '2024-02-22 18:47:17',
                'display_group' => 'User',
                'display_name' => 'Edit Users',
                'id' => 220,
                'permission_code' => 'users.edit',
                'updated_at' => NULL,
            ),
            18 => 
            array (
                'created_at' => '2024-02-22 18:47:17',
                'display_group' => 'User',
                'display_name' => 'Show Users',
                'id' => 221,
                'permission_code' => 'users.show',
                'updated_at' => NULL,
            ),
            19 => 
            array (
                'created_at' => '2024-02-22 18:47:17',
                'display_group' => 'User',
                'display_name' => 'Delete Users',
                'id' => 222,
                'permission_code' => 'users.delete',
                'updated_at' => NULL,
            ),
            20 => 
            array (
                'created_at' => '2024-02-22 23:47:17',
                'display_group' => 'Bank Account',
                'display_name' => 'Delete Bank Account',
                'id' => 223,
                'permission_code' => 'bank_accounts.delete',
                'updated_at' => NULL,
            ),
            21 => 
            array (
                'created_at' => '2024-02-22 23:47:17',
                'display_group' => 'Bank Account',
                'display_name' => 'Show Bank Account',
                'id' => 224,
                'permission_code' => 'bank_accounts.show',
                'updated_at' => NULL,
            ),
            22 => 
            array (
                'created_at' => '2024-02-22 23:47:17',
                'display_group' => 'Bank Account',
                'display_name' => 'Edit Bank Account',
                'id' => 225,
                'permission_code' => 'bank_accounts.edit',
                'updated_at' => NULL,
            ),
            23 => 
            array (
                'created_at' => '2024-02-22 23:47:17',
                'display_group' => 'Bank Account',
                'display_name' => 'Add Bank Account',
                'id' => 226,
                'permission_code' => 'bank_accounts.add',
                'updated_at' => NULL,
            ),
            24 => 
            array (
                'created_at' => '2024-02-22 23:47:17',
                'display_group' => 'Bank Account',
                'display_name' => 'Bank Accounts Index',
                'id' => 227,
                'permission_code' => 'bank_accounts.index',
                'updated_at' => NULL,
            ),
            25 => 
            array (
                'created_at' => '2024-02-22 23:47:17',
                'display_group' => 'Bank Account',
                'display_name' => 'Export Bank Account',
                'id' => 228,
                'permission_code' => 'bank_accounts.export',
                'updated_at' => NULL,
            ),
            26 => 
            array (
                'created_at' => '2024-02-22 23:47:17',
                'display_group' => 'Bank Account',
                'display_name' => 'Import Bank Account',
                'id' => 229,
                'permission_code' => 'bank_accounts.import',
                'updated_at' => NULL,
            ),
            27 => 
            array (
                'created_at' => '2024-02-22 23:47:17',
                'display_group' => 'Bank Account',
                'display_name' => 'Bank Transactions Index',
                'id' => 230,
                'permission_code' => 'bank_transactions.index',
                'updated_at' => NULL,
            ),
            28 => 
            array (
                'created_at' => '2024-02-22 23:47:17',
                'display_group' => 'Bank Account',
                'display_name' => 'Add Bank Transaction',
                'id' => 231,
                'permission_code' => 'bank_transactions.add',
                'updated_at' => NULL,
            ),
            29 => 
            array (
                'created_at' => '2024-02-22 23:47:17',
                'display_group' => 'Bank Account',
                'display_name' => 'Edit Bank Transactions',
                'id' => 232,
                'permission_code' => 'bank_transactions.edit',
                'updated_at' => NULL,
            ),
            30 => 
            array (
                'created_at' => '2024-02-22 23:47:17',
                'display_group' => 'Bank Account',
                'display_name' => 'Show Bank Transactions',
                'id' => 233,
                'permission_code' => 'bank_transactions.show',
                'updated_at' => NULL,
            ),
            31 => 
            array (
                'created_at' => '2024-02-22 23:47:17',
                'display_group' => 'Bank Account',
                'display_name' => 'Delete BankTransaction',
                'id' => 234,
                'permission_code' => 'bank_transactions.delete',
                'updated_at' => NULL,
            ),
            32 => 
            array (
                'created_at' => '2024-05-14 22:26:07',
                'display_group' => 'Bank Account',
                'display_name' => 'Export Bank Transactions',
                'id' => 235,
                'permission_code' => 'bank_transactions.export',
                'updated_at' => NULL,
            ),
            33 => 
            array (
                'created_at' => '2024-05-14 22:26:07',
                'display_group' => 'Bank Account',
                'display_name' => 'Import Bank Transaction',
                'id' => 236,
                'permission_code' => 'bank_transactions.import',
                'updated_at' => NULL,
            ),
            34 => 
            array (
                'created_at' => '2024-02-22 23:47:17',
                'display_group' => 'Setting',
                'display_name' => 'Notification Setting Index',
                'id' => 237,
                'permission_code' => 'notification_setting.index',
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}