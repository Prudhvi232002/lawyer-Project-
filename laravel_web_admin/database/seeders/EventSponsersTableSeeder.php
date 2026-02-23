<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class EventSponsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('event_sponsers')->delete();
        
        \DB::table('event_sponsers')->insert(array (
            0 => 
            array (
                'created_at' => '2023-09-05 16:00:23',
                'deleted_at' => '2023-09-05 16:02:02',
                'event_id' => 16,
                'id' => 1,
            'image' => '/files/event_sponsers/1693929623download (2).jpeg',
                'name' => 'Deleniti dolore exce',
                'updated_at' => '2023-09-05 16:02:02',
            ),
            1 => 
            array (
                'created_at' => '2023-09-05 16:00:23',
                'deleted_at' => '2023-09-05 16:02:02',
                'event_id' => 16,
                'id' => 2,
                'image' => '/files/event_sponsers/1693929623download.jpeg',
                'name' => 'Id voluptas ex cupid',
                'updated_at' => '2023-09-05 16:02:02',
            ),
            2 => 
            array (
                'created_at' => '2023-10-03 17:05:41',
                'deleted_at' => NULL,
                'event_id' => 8,
                'id' => 6,
                'image' => '/files/event_sponsers/1696334741dashboard-image-1.png',
                'name' => 'Sponser Name',
                'updated_at' => '2023-10-03 17:05:41',
            ),
            3 => 
            array (
                'created_at' => '2023-10-04 12:56:33',
                'deleted_at' => '2023-10-04 16:16:48',
                'event_id' => 10,
                'id' => 7,
                'image' => '/files/event_sponsers/1696406193tick-icon.png',
                'name' => 'Legitadvisor',
                'updated_at' => '2023-10-04 16:16:48',
            ),
            4 => 
            array (
                'created_at' => '2023-10-04 16:16:48',
                'deleted_at' => '2023-10-11 20:44:48',
                'event_id' => 10,
                'id' => 8,
                'image' => '/files/event_sponsers/1696418208tick-icon.png',
                'name' => 'Legitadvisor',
                'updated_at' => '2023-10-11 20:44:48',
            ),
            5 => 
            array (
                'created_at' => '2023-10-05 11:40:27',
                'deleted_at' => '2023-10-11 20:36:57',
                'event_id' => 11,
                'id' => 9,
                'image' => '/files/event_sponsers/1696488027100 x 100.png',
                'name' => 'Legit Advisor',
                'updated_at' => '2023-10-11 20:36:57',
            ),
            6 => 
            array (
                'created_at' => '2023-10-11 20:36:57',
                'deleted_at' => NULL,
                'event_id' => 11,
                'id' => 10,
                'image' => '/files/event_sponsers/1697038617law-legal-justice-graphic_24877-52551.avif',
                'name' => 'logo',
                'updated_at' => '2023-10-11 20:36:57',
            ),
            7 => 
            array (
                'created_at' => '2023-10-11 20:44:48',
                'deleted_at' => '2023-10-12 17:41:22',
                'event_id' => 10,
                'id' => 11,
                'image' => '/files/event_sponsers/1697039088hand-drawn-advocate-logo-design_23-2150640393.avif',
                'name' => 'Legitadvisor',
                'updated_at' => '2023-10-12 17:41:22',
            ),
            8 => 
            array (
                'created_at' => '2023-10-11 20:53:40',
                'deleted_at' => '2023-10-12 17:43:10',
                'event_id' => 9,
                'id' => 12,
            'image' => '/files/event_sponsers/1697039620hand-drawn-advocate-logo-design_23-2150640393 (1).avif',
                'name' => 'legal',
                'updated_at' => '2023-10-12 17:43:10',
            ),
            9 => 
            array (
                'created_at' => '2023-10-11 21:04:24',
                'deleted_at' => '2023-10-12 16:21:23',
                'event_id' => 5,
                'id' => 13,
                'image' => '/files/event_sponsers/1697040264law-legal-justice-graphic_24877-52551.avif',
                'name' => 'legal',
                'updated_at' => '2023-10-12 16:21:23',
            ),
            10 => 
            array (
                'created_at' => '2023-10-12 15:39:46',
                'deleted_at' => NULL,
                'event_id' => 12,
                'id' => 14,
                'image' => '/files/event_sponsers/1697107186copyright-law-day-banner-design_1308-121882.avif',
                'name' => 'legal',
                'updated_at' => '2023-10-12 15:39:46',
            ),
            11 => 
            array (
                'created_at' => '2023-10-12 15:44:21',
                'deleted_at' => NULL,
                'event_id' => 13,
                'id' => 16,
                'image' => '/files/event_sponsers/1697107461hand-drawn-advocate-logo-design_23-2150640393.avif',
                'name' => 'legal',
                'updated_at' => '2023-10-12 15:44:21',
            ),
            12 => 
            array (
                'created_at' => '2023-10-12 15:50:28',
                'deleted_at' => NULL,
                'event_id' => 14,
                'id' => 17,
                'image' => '/files/event_sponsers/1697107828hand-drawn-advocate-logo-design_23-2150640393.avif',
                'name' => 'legal',
                'updated_at' => '2023-10-12 15:50:28',
            ),
            13 => 
            array (
                'created_at' => '2023-10-12 15:54:40',
                'deleted_at' => NULL,
                'event_id' => 15,
                'id' => 18,
                'image' => '/files/event_sponsers/1697108080sponsor-stickers-collection_23-2148737616.avif',
                'name' => 'Logo',
                'updated_at' => '2023-10-12 15:54:40',
            ),
            14 => 
            array (
                'created_at' => '2023-10-12 16:01:59',
                'deleted_at' => NULL,
                'event_id' => 16,
                'id' => 19,
                'image' => '/files/event_sponsers/1697108519law-legal-justice-graphic_24877-52551.avif',
                'name' => 'Logo',
                'updated_at' => '2023-10-12 16:01:59',
            ),
            15 => 
            array (
                'created_at' => '2023-10-12 16:09:04',
                'deleted_at' => '2023-10-12 17:39:48',
                'event_id' => 18,
                'id' => 20,
                'image' => '/files/event_sponsers/1697108944hand-drawn-advocate-logo-design_23-2150652390.avif',
                'name' => 'Logo',
                'updated_at' => '2023-10-12 17:39:48',
            ),
            16 => 
            array (
                'created_at' => '2023-10-12 16:19:03',
                'deleted_at' => '2023-10-12 17:38:44',
                'event_id' => 17,
                'id' => 21,
            'image' => '/files/event_sponsers/1697109543law-firm-logo-icon-design-template-vector_9999-1654 (1).avif',
                'name' => 'Logo',
                'updated_at' => '2023-10-12 17:38:44',
            ),
            17 => 
            array (
                'created_at' => '2023-10-12 16:21:23',
                'deleted_at' => '2023-10-12 16:22:20',
                'event_id' => 5,
                'id' => 22,
            'image' => '/files/event_sponsers/1697109683world-day-social-justice-banner_1308-127133 (1).avif',
                'name' => 'legal',
                'updated_at' => '2023-10-12 16:22:20',
            ),
            18 => 
            array (
                'created_at' => '2023-10-12 16:22:20',
                'deleted_at' => '2023-10-12 16:23:18',
                'event_id' => 5,
                'id' => 23,
            'image' => '/files/event_sponsers/1697109740world-day-social-justice-banner_1308-127133 (1).avif',
                'name' => 'legal',
                'updated_at' => '2023-10-12 16:23:18',
            ),
            19 => 
            array (
                'created_at' => '2023-10-12 16:23:18',
                'deleted_at' => '2023-10-12 16:24:05',
                'event_id' => 5,
                'id' => 24,
            'image' => '/files/event_sponsers/1697109798world-day-social-justice-banner_1308-127133 (1).avif',
                'name' => 'legal',
                'updated_at' => '2023-10-12 16:24:05',
            ),
            20 => 
            array (
                'created_at' => '2023-10-12 16:24:05',
                'deleted_at' => '2023-10-12 16:32:07',
                'event_id' => 5,
                'id' => 25,
            'image' => '/files/event_sponsers/1697109845world-day-social-justice-banner_1308-127133 (1).avif',
                'name' => 'legal',
                'updated_at' => '2023-10-12 16:32:07',
            ),
            21 => 
            array (
                'created_at' => '2023-10-12 16:32:07',
                'deleted_at' => '2023-10-12 16:35:56',
                'event_id' => 5,
                'id' => 26,
            'image' => '/files/event_sponsers/1697110327world-day-social-justice-banner_1308-127133 (1).avif',
                'name' => 'legal',
                'updated_at' => '2023-10-12 16:35:56',
            ),
            22 => 
            array (
                'created_at' => '2023-10-12 16:35:56',
                'deleted_at' => '2023-10-19 14:34:21',
                'event_id' => 5,
                'id' => 27,
                'image' => '/files/event_sponsers/1697110556world-day-social-justice-banner_1308-127133.avif',
                'name' => 'legal',
                'updated_at' => '2023-10-19 14:34:21',
            ),
            23 => 
            array (
                'created_at' => '2023-10-12 17:38:44',
                'deleted_at' => NULL,
                'event_id' => 17,
                'id' => 28,
            'image' => '/files/event_sponsers/1697114324law-firm-logo-icon-design-template-vector_9999-1654 (1).avif',
                'name' => 'Logo',
                'updated_at' => '2023-10-12 17:38:44',
            ),
            24 => 
            array (
                'created_at' => '2023-10-12 17:39:48',
                'deleted_at' => NULL,
                'event_id' => 18,
                'id' => 29,
                'image' => '/files/event_sponsers/1697114388world-day-social-justice-banner_1308-127133.avif',
                'name' => 'Logo',
                'updated_at' => '2023-10-12 17:39:48',
            ),
            25 => 
            array (
                'created_at' => '2023-10-12 17:41:22',
                'deleted_at' => NULL,
                'event_id' => 10,
                'id' => 30,
                'image' => '/files/event_sponsers/1697114482world-day-social-justice-banner_1308-127133.avif',
                'name' => 'Legitadvisor',
                'updated_at' => '2023-10-12 17:41:22',
            ),
            26 => 
            array (
                'created_at' => '2023-10-12 17:43:10',
                'deleted_at' => '2023-10-12 17:43:56',
                'event_id' => 9,
                'id' => 31,
            'image' => '/files/event_sponsers/1697114590world-day-social-justice-banner_1308-127133 (1).avif',
                'name' => 'legal',
                'updated_at' => '2023-10-12 17:43:56',
            ),
            27 => 
            array (
                'created_at' => '2023-10-12 17:43:10',
                'deleted_at' => '2023-10-12 17:43:56',
                'event_id' => 9,
                'id' => 32,
                'image' => '/files/event_sponsers/1697114590world-day-social-justice-banner_1308-127133.avif',
                'name' => 'logo',
                'updated_at' => '2023-10-12 17:43:56',
            ),
            28 => 
            array (
                'created_at' => '2023-10-12 17:43:56',
                'deleted_at' => NULL,
                'event_id' => 9,
                'id' => 33,
            'image' => '/files/event_sponsers/1697114636world-day-social-justice-banner_1308-127133 (1).avif',
                'name' => 'legal',
                'updated_at' => '2023-10-12 17:43:56',
            ),
            29 => 
            array (
                'created_at' => '2023-10-12 17:43:56',
                'deleted_at' => NULL,
                'event_id' => 9,
                'id' => 34,
                'image' => '/files/event_sponsers/1697114636world-day-social-justice-banner_1308-127133.avif',
                'name' => 'logo',
                'updated_at' => '2023-10-12 17:43:56',
            ),
            30 => 
            array (
                'created_at' => '2023-10-13 16:41:05',
                'deleted_at' => '2023-10-30 16:51:31',
                'event_id' => 23,
                'id' => 35,
                'image' => '/files/event_sponsers/1697197265hand-drawn-advocate-logo-design_23-2150640387.avif',
                'name' => 'Logo',
                'updated_at' => '2023-10-30 16:51:31',
            ),
            31 => 
            array (
                'created_at' => '2023-10-13 16:47:12',
                'deleted_at' => NULL,
                'event_id' => 24,
                'id' => 36,
                'image' => NULL,
                'name' => 'logo',
                'updated_at' => '2023-10-13 16:47:12',
            ),
            32 => 
            array (
                'created_at' => '2023-10-13 18:54:50',
                'deleted_at' => NULL,
                'event_id' => 27,
                'id' => 37,
                'image' => '/files/event_sponsers/1697205290hand-drawn-advocate-logo-design_23-2150640387.avif',
                'name' => 'ASF',
                'updated_at' => '2023-10-13 18:54:50',
            ),
            33 => 
            array (
                'created_at' => '2023-10-12 16:35:56',
                'deleted_at' => NULL,
                'event_id' => 28,
                'id' => 38,
                'image' => '/files/event_sponsers/1697110556world-day-social-justice-banner_1308-127133.avif',
                'name' => 'legal',
                'updated_at' => '2023-10-12 16:35:56',
            ),
            34 => 
            array (
                'created_at' => '2023-10-12 17:38:44',
                'deleted_at' => NULL,
                'event_id' => 29,
                'id' => 39,
            'image' => '/files/event_sponsers/1697114324law-firm-logo-icon-design-template-vector_9999-1654 (1).avif',
                'name' => 'Logo',
                'updated_at' => '2023-10-12 17:38:44',
            ),
            35 => 
            array (
                'created_at' => '2023-10-19 14:34:21',
                'deleted_at' => NULL,
                'event_id' => 5,
                'id' => 40,
            'image' => '/files/event_sponsers/1697708061advocate-logo-design-template_23-2150628876 (1).avif',
                'name' => 'legal',
                'updated_at' => '2023-10-19 14:34:21',
            ),
            36 => 
            array (
                'created_at' => '2023-10-24 18:25:39',
                'deleted_at' => '2023-10-30 16:23:18',
                'event_id' => 208,
                'id' => 41,
                'image' => '/files/event_sponsers/1698153939gradient-advocate-logo-template_23-2150670338.avif',
                'name' => 'lawyer',
                'updated_at' => '2023-10-30 16:23:18',
            ),
            37 => 
            array (
                'created_at' => '2023-10-24 18:28:07',
                'deleted_at' => '2023-10-24 18:29:38',
                'event_id' => 209,
                'id' => 42,
                'image' => '/files/event_sponsers/1698154087law-firm-logo-icon-design-template-vector_9999-1654.avif',
                'name' => NULL,
                'updated_at' => '2023-10-24 18:29:38',
            ),
            38 => 
            array (
                'created_at' => '2023-10-24 18:29:38',
                'deleted_at' => '2023-10-24 18:32:27',
                'event_id' => 209,
                'id' => 43,
                'image' => '/files/event_sponsers/1698154087law-firm-logo-icon-design-template-vector_9999-1654.avif',
                'name' => NULL,
                'updated_at' => '2023-10-24 18:32:27',
            ),
            39 => 
            array (
                'created_at' => '2023-10-24 18:32:27',
                'deleted_at' => '2023-10-24 18:37:30',
                'event_id' => 209,
                'id' => 44,
                'image' => '/files/event_sponsers/1698154087law-firm-logo-icon-design-template-vector_9999-1654.avif',
                'name' => NULL,
                'updated_at' => '2023-10-24 18:37:30',
            ),
            40 => 
            array (
                'created_at' => '2023-10-24 18:37:30',
                'deleted_at' => '2023-10-30 16:21:35',
                'event_id' => 209,
                'id' => 45,
                'image' => '/files/event_sponsers/1698154087law-firm-logo-icon-design-template-vector_9999-1654.avif',
                'name' => NULL,
                'updated_at' => '2023-10-30 16:21:35',
            ),
            41 => 
            array (
                'created_at' => '2023-10-30 16:21:35',
                'deleted_at' => NULL,
                'event_id' => 209,
                'id' => 46,
                'image' => '/files/event_sponsers/1698154087law-firm-logo-icon-design-template-vector_9999-1654.avif',
                'name' => 'LawFirm',
                'updated_at' => '2023-10-30 16:21:35',
            ),
            42 => 
            array (
                'created_at' => '2023-10-30 16:23:18',
                'deleted_at' => NULL,
                'event_id' => 208,
                'id' => 47,
                'image' => '/files/event_sponsers/1698153939gradient-advocate-logo-template_23-2150670338.avif',
                'name' => 'lawyer',
                'updated_at' => '2023-10-30 16:23:18',
            ),
            43 => 
            array (
                'created_at' => '2023-10-30 16:51:31',
                'deleted_at' => NULL,
                'event_id' => 23,
                'id' => 48,
            'image' => '/files/event_sponsers/1698666691hand-drawn-advocate-logo-design_23-2150640399 (1).avif',
                'name' => 'Logo',
                'updated_at' => '2023-10-30 16:51:31',
            ),
            44 => 
            array (
                'created_at' => '2023-10-30 17:01:59',
                'deleted_at' => NULL,
                'event_id' => 112,
                'id' => 49,
            'image' => '/files/event_sponsers/1698667319advocate-logo-design-template_23-2150628876 (1).avif',
                'name' => 'legal',
                'updated_at' => '2023-10-30 17:01:59',
            ),
            45 => 
            array (
                'created_at' => '2023-10-30 17:06:28',
                'deleted_at' => '2023-10-30 17:08:55',
                'event_id' => 205,
                'id' => 50,
            'image' => '/files/event_sponsers/1698667588advocate-logo-design-template_23-2150628876 (1).avif',
                'name' => 'Logo',
                'updated_at' => '2023-10-30 17:08:55',
            ),
            46 => 
            array (
                'created_at' => '2023-10-30 17:08:55',
                'deleted_at' => NULL,
                'event_id' => 205,
                'id' => 51,
            'image' => '/files/event_sponsers/1698667735hand-drawn-advocate-logo-design_23-2150640399 (1).avif',
                'name' => 'Logo',
                'updated_at' => '2023-10-30 17:08:55',
            ),
            47 => 
            array (
                'created_at' => '2023-10-30 17:12:14',
                'deleted_at' => NULL,
                'event_id' => 204,
                'id' => 52,
            'image' => '/files/event_sponsers/1698667934advocate-logo-design-template_23-2150628876 (1).avif',
                'name' => 'Logo',
                'updated_at' => '2023-10-30 17:12:14',
            ),
            48 => 
            array (
                'created_at' => '2023-10-30 17:15:35',
                'deleted_at' => NULL,
                'event_id' => 203,
                'id' => 53,
            'image' => '/files/event_sponsers/1698668135advocate-logo-design-template_23-2150628876 (1).avif',
                'name' => 'Logo',
                'updated_at' => '2023-10-30 17:15:35',
            ),
            49 => 
            array (
                'created_at' => '2023-10-30 17:19:20',
                'deleted_at' => NULL,
                'event_id' => 185,
                'id' => 54,
            'image' => '/files/event_sponsers/1698668360advocate-logo-design-template_23-2150628876 (1).avif',
                'name' => 'Logo',
                'updated_at' => '2023-10-30 17:19:20',
            ),
            50 => 
            array (
                'created_at' => '2023-10-30 17:22:14',
                'deleted_at' => NULL,
                'event_id' => 201,
                'id' => 55,
            'image' => '/files/event_sponsers/1698668534advocate-logo-design-template_23-2150628876 (1).avif',
                'name' => 'Logo',
                'updated_at' => '2023-10-30 17:22:14',
            ),
            51 => 
            array (
                'created_at' => '2023-10-30 17:25:44',
                'deleted_at' => NULL,
                'event_id' => 181,
                'id' => 56,
                'image' => '/files/event_sponsers/1698668744dark-lawyer-logo-design_1051-1626.avif',
                'name' => 'Logo',
                'updated_at' => '2023-10-30 17:25:44',
            ),
            52 => 
            array (
                'created_at' => '2023-10-30 17:32:22',
                'deleted_at' => '2023-10-30 17:34:06',
                'event_id' => 200,
                'id' => 57,
            'image' => '/files/event_sponsers/1698669142hand-drawn-advocate-logo-design_23-2150640399 (1).avif',
                'name' => 'Logo',
                'updated_at' => '2023-10-30 17:34:06',
            ),
            53 => 
            array (
                'created_at' => '2023-10-30 17:34:06',
                'deleted_at' => NULL,
                'event_id' => 200,
                'id' => 58,
                'image' => '/files/event_sponsers/1698669246dark-lawyer-logo-design_1051-1626.avif',
                'name' => 'Logo',
                'updated_at' => '2023-10-30 17:34:06',
            ),
            54 => 
            array (
                'created_at' => '2023-11-01 18:43:33',
                'deleted_at' => '2023-11-01 18:46:10',
                'event_id' => 211,
                'id' => 59,
                'image' => '/files/event_sponsers/1698846213hand-drawn-advocate-logo-design_23-2150640387.avif',
                'name' => 'Legal',
                'updated_at' => '2023-11-01 18:46:10',
            ),
            55 => 
            array (
                'created_at' => '2023-11-01 18:46:10',
                'deleted_at' => NULL,
                'event_id' => 211,
                'id' => 60,
                'image' => '/files/event_sponsers/1698846370gradient-advocate-logo-template_23-2150670338.avif',
                'name' => 'Legal',
                'updated_at' => '2023-11-01 18:46:10',
            ),
        ));
        
        
    }
}