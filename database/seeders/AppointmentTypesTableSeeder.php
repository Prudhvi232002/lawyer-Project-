<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AppointmentTypesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('appointment_types')->delete();
        
        \DB::table('appointment_types')->insert(array (
            0 => 
            array (
                'created_at' => '2023-05-21 17:21:25',
                'deleted_at' => NULL,
                'description' => 'Video Call',
                'display_name' => 'Video Call',
                'id' => 1,
                'is_active' => 1,
                'is_paid' => 1,
                'is_schedule_required' => 1,
                'type' => 'video',
                'updated_at' => '2023-05-21 17:21:25',
            ),
            1 => 
            array (
                'created_at' => '2023-05-21 17:21:51',
                'deleted_at' => NULL,
                'description' => 'Audio Call',
                'display_name' => 'Audio Call',
                'id' => 2,
                'is_active' => 1,
                'is_paid' => 1,
                'is_schedule_required' => 1,
                'type' => 'audio',
                'updated_at' => '2023-05-21 17:21:51',
            ),
            2 => 
            array (
                'created_at' => '2023-05-21 17:22:16',
                'deleted_at' => NULL,
                'description' => 'Live Chat',
                'display_name' => 'Live Chat',
                'id' => 3,
                'is_active' => 1,
                'is_paid' => 1,
                'is_schedule_required' => 0,
                'type' => 'chat',
                'updated_at' => '2023-05-21 17:22:16',
            ),
        ));
        
        
    }
}