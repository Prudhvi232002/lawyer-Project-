<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LawyerEducationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('lawyer_educations')->delete();
        
        \DB::table('lawyer_educations')->insert(array (
            0 => 
            array (
                'created_at' => '2023-08-05 08:53:46',
                'degree' => 'bscs updated',
                'deleted_at' => '2023-08-05 09:00:57',
                'description' => '<p>trignotrignotrignotrignotrignotrignotrigno</p>',
                'from' => '2017-08-16 00:00:00',
                'id' => 1,
            'image' => '/files/lawyer_educations/1691225626download (1).jpeg',
                'institute' => 'trigno updated',
                'is_active' => 1,
                'lawyer_id' => 2,
                'subject' => 'computer updated',
                'to' => '2023-08-05 00:00:00',
                'updated_at' => '2023-08-05 09:00:57',
            ),
            1 => 
            array (
                'created_at' => '2023-08-09 12:19:48',
                'degree' => 'LLB',
                'deleted_at' => NULL,
                'description' => '<p>test educations&nbsp;</p>',
                'from' => '2008-08-29 08:19:00',
                'id' => 2,
                'image' => '/files/lawyer_educations/1691572788Isabella Carrington .jpg',
                'institute' => 'Law university  of london',
                'is_active' => 1,
                'lawyer_id' => 15,
                'subject' => 'Education Law',
                'to' => '2014-08-15 09:19:00',
                'updated_at' => '2023-08-09 12:19:48',
            ),
            2 => 
            array (
                'created_at' => '2023-10-13 18:31:14',
                'degree' => 'FSC',
                'deleted_at' => NULL,
                'description' => '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged</p>',
                'from' => '2020-09-18 13:29:00',
                'id' => 3,
                'image' => '/files/lawyer_educations/1697203874law-template-poster-design_23-2149194024.pdf',
                'institute' => 'Law Advisor',
                'is_active' => 1,
                'lawyer_id' => 14,
                'subject' => 'Lawyer',
                'to' => '2023-10-10 13:29:00',
                'updated_at' => '2023-10-13 18:31:14',
            ),
            3 => 
            array (
                'created_at' => '2024-01-08 17:27:06',
                'degree' => 'BS',
                'deleted_at' => NULL,
                'description' => NULL,
                'from' => '2023-12-08 00:00:00',
                'id' => 4,
            'image' => '/files/lawyer_educations/1704716826Monosnap 785fdf29a9c17894b66d4f9e1970cf70_jpg_750x750_jpg_1024x1024.webp (750×750) 2023-12-20 17-18-47.png',
                'institute' => 'The Company',
                'is_active' => 1,
                'lawyer_id' => 15,
                'subject' => 'CS',
                'to' => '2023-12-08 00:00:00',
                'updated_at' => '2024-01-08 17:27:06',
            ),
            4 => 
            array (
                'created_at' => '2024-01-08 18:27:50',
                'degree' => 'BS',
                'deleted_at' => NULL,
                'description' => NULL,
                'from' => '2023-12-08 00:00:00',
                'id' => 5,
            'image' => '/files/lawyer_educations/1704720470Monosnap 785fdf29a9c17894b66d4f9e1970cf70_jpg_750x750_jpg_1024x1024.webp (750×750) 2023-12-20 17-18-47.png',
                'institute' => 'The Company',
                'is_active' => 1,
                'lawyer_id' => 15,
                'subject' => 'CS',
                'to' => '2023-12-08 00:00:00',
                'updated_at' => '2024-01-08 18:27:50',
            ),
            5 => 
            array (
                'created_at' => '2024-01-17 17:04:13',
                'degree' => 'sd',
                'deleted_at' => NULL,
                'description' => 'asd',
                'from' => '1970-01-01 00:00:12',
                'id' => 6,
                'image' => '/files/lawyer_educations/1705493053images.jpeg',
                'institute' => 'asd',
                'is_active' => 1,
                'lawyer_id' => 15,
                'subject' => 'asd',
                'to' => '1970-01-01 00:00:12',
                'updated_at' => '2024-01-17 17:04:13',
            ),
            6 => 
            array (
                'created_at' => '2024-01-17 17:05:07',
                'degree' => 'sdf',
                'deleted_at' => NULL,
                'description' => 'sdf',
                'from' => '1970-01-01 00:00:12',
                'id' => 7,
                'image' => '/files/lawyer_educations/1705493107pexels-pixabay-268533.jpg',
                'institute' => 'sdf',
                'is_active' => 1,
                'lawyer_id' => 15,
                'subject' => 'sf',
                'to' => '1970-01-01 00:00:32',
                'updated_at' => '2024-01-17 17:05:07',
            ),
            7 => 
            array (
                'created_at' => '2024-01-17 17:05:40',
                'degree' => 'sdf',
                'deleted_at' => NULL,
                'description' => 'sdf',
                'from' => '1970-01-01 00:00:12',
                'id' => 8,
                'image' => '/files/lawyer_educations/1705493140pexels-pixabay-268533.jpg',
                'institute' => 'sdf',
                'is_active' => 1,
                'lawyer_id' => 15,
                'subject' => 'sf',
                'to' => '1970-01-01 00:00:32',
                'updated_at' => '2024-01-17 17:05:40',
            ),
            8 => 
            array (
                'created_at' => '2024-01-17 17:06:39',
                'degree' => 'BS',
                'deleted_at' => NULL,
                'description' => NULL,
                'from' => '2023-12-08 00:00:00',
                'id' => 9,
                'image' => '/files/lawyer_educations/1705493199009861_09_Jan_2024.pdf',
                'institute' => 'The Company',
                'is_active' => 1,
                'lawyer_id' => 15,
                'subject' => 'CS',
                'to' => '2023-12-08 00:00:00',
                'updated_at' => '2024-01-17 17:06:39',
            ),
            9 => 
            array (
                'created_at' => '2024-01-17 17:11:14',
                'degree' => 'sdf',
                'deleted_at' => '2024-01-17 17:56:19',
                'description' => 'sdf',
                'from' => '1970-01-01 00:00:12',
                'id' => 10,
                'image' => '/files/lawyer_educations/1705493474pexels-pixabay-268533.jpg',
                'institute' => 'sdf',
                'is_active' => 1,
                'lawyer_id' => 15,
                'subject' => 'sf',
                'to' => '1970-01-01 00:00:32',
                'updated_at' => '2024-01-17 17:56:19',
            ),
            10 => 
            array (
                'created_at' => '2024-01-17 17:56:52',
                'degree' => 'gbb',
                'deleted_at' => NULL,
                'description' => 'ghb',
                'from' => '1970-01-01 00:10:46',
                'id' => 11,
                'image' => '/files/lawyer_educations/1705496212Screenshot_2024-01-16-14-57-03-911_com.lawadvisor.lawyer.jpg',
                'institute' => 'test',
                'is_active' => 1,
                'lawyer_id' => 15,
                'subject' => 'xvb',
                'to' => '1970-01-01 00:09:27',
                'updated_at' => '2024-01-17 17:56:52',
            ),
            11 => 
            array (
                'created_at' => '2024-01-22 18:58:38',
                'degree' => 'Deg',
                'deleted_at' => NULL,
                'description' => 'AAU i',
                'from' => '1970-01-01 00:33:36',
                'id' => 12,
                'image' => '/files/lawyer_educations/1705931918Screenshot_2024-01-22-13-46-05-598_com.linkedin.android.jpg',
                'institute' => 'AAU',
                'is_active' => 1,
                'lawyer_id' => 46,
                'subject' => 'Pedi',
                'to' => '1970-01-01 00:33:44',
                'updated_at' => '2024-01-22 18:58:38',
            ),
        ));
        
        
    }
}