<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LawyerExperiencesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('lawyer_experiences')->delete();
        
        \DB::table('lawyer_experiences')->insert(array (
            0 => 
            array (
                'company' => 'gjkgjkg',
                'created_at' => '2023-08-04 16:41:20',
                'deleted_at' => '2023-08-04 17:03:41',
                'description' => NULL,
                'from' => NULL,
                'id' => 1,
                'image' => NULL,
                'is_active' => 0,
                'lawyer_id' => 2,
                'to' => NULL,
                'updated_at' => '2023-08-04 17:03:41',
            ),
            1 => 
            array (
                'company' => 'Updated',
                'created_at' => '2023-08-04 16:42:58',
                'deleted_at' => NULL,
                'description' => '<p>updatewd</p><p>&nbsp;</p>',
                'from' => '2023-08-02 00:00:00',
                'id' => 2,
            'image' => '/files/lawyer_experiences/1691167378download (2).jpeg',
                'is_active' => 1,
                'lawyer_id' => 2,
                'to' => '2023-08-16 00:00:00',
                'updated_at' => '2023-08-04 16:59:18',
            ),
            2 => 
            array (
                'company' => 'Trigno',
                'created_at' => '2023-08-04 16:50:44',
                'deleted_at' => NULL,
                'description' => '<p>experiences</p>',
                'from' => '2020-08-29 16:50:00',
                'id' => 3,
            'image' => '/files/lawyer_experiences/1691167844download (1).jpeg',
                'is_active' => 1,
                'lawyer_id' => 2,
                'to' => '2023-08-26 16:50:00',
                'updated_at' => '2023-08-04 16:50:44',
            ),
            3 => 
            array (
                'company' => 'Isabella Law',
                'created_at' => '2023-08-09 12:18:17',
                'deleted_at' => NULL,
                'description' => '<p>test experience&nbsp;</p>',
                'from' => '2008-08-16 12:17:00',
                'id' => 4,
                'image' => '/files/lawyer_experiences/1691572697Isabella Carrington .jpg',
                'is_active' => 1,
                'lawyer_id' => 15,
                'to' => '2023-08-16 12:17:00',
                'updated_at' => '2023-08-09 12:18:17',
            ),
            4 => 
            array (
                'company' => 'Law Advisor',
                'created_at' => '2023-10-13 18:23:55',
                'deleted_at' => NULL,
                'description' => '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged</p>',
                'from' => '2014-10-18 18:10:00',
                'id' => 5,
                'image' => '/files/lawyer_experiences/1697203435law-template-poster-design_23-2149194024.pdf',
                'is_active' => 1,
                'lawyer_id' => 14,
                'to' => '2023-10-06 18:10:00',
                'updated_at' => '2023-10-13 18:23:55',
            ),
            5 => 
            array (
                'company' => 'ok',
                'created_at' => '2024-01-17 17:34:42',
                'deleted_at' => NULL,
                'description' => 'as',
                'from' => '1970-01-01 05:00:12',
                'id' => 6,
                'image' => '/files/lawyer_experiences/1705494882images.jpeg',
                'is_active' => 1,
                'lawyer_id' => 15,
                'to' => '1970-01-01 05:00:23',
                'updated_at' => '2024-01-17 17:34:42',
            ),
            6 => 
            array (
                'company' => 'Francisco de Orellana',
                'created_at' => '2024-02-01 19:20:31',
                'deleted_at' => NULL,
                'description' => '<p>Francisco de Orellana</p>',
                'from' => '2024-02-01 19:20:00',
                'id' => 7,
                'image' => '/files/lawyer_experiences/1706797231Sin título-1.jpg',
                'is_active' => 0,
                'lawyer_id' => 37,
                'to' => '2024-02-29 19:20:00',
                'updated_at' => '2024-02-01 19:20:31',
            ),
        ));
        
        
    }
}