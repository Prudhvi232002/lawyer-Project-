<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AppointmentRatingsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('appointment_ratings')->delete();
        
        \DB::table('appointment_ratings')->insert(array (
            0 => 
            array (
                'booked_appointment_id' => 5,
                'comment' => 'fgg',
                'created_at' => '2023-08-16 16:25:36',
                'deleted_at' => NULL,
                'fromable_id' => 4,
                'fromable_type' => 'App\\Models\\Customer',
                'id' => 1,
                'rating' => 3.0,
                'to_id' => 15,
                'to_type' => 'App\\Models\\Lawyer',
                'updated_at' => '2023-08-16 16:25:36',
            ),
            1 => 
            array (
                'booked_appointment_id' => 8,
                'comment' => 'thanks',
                'created_at' => '2023-08-29 15:41:19',
                'deleted_at' => NULL,
                'fromable_id' => 15,
                'fromable_type' => 'App\\Models\\Lawyer',
                'id' => 2,
                'rating' => 5.0,
                'to_id' => 4,
                'to_type' => 'App\\Models\\Customer',
                'updated_at' => '2023-08-29 15:41:19',
            ),
            2 => 
            array (
                'booked_appointment_id' => 8,
                'comment' => 'good',
                'created_at' => '2023-08-29 15:41:22',
                'deleted_at' => NULL,
                'fromable_id' => 4,
                'fromable_type' => 'App\\Models\\Customer',
                'id' => 3,
                'rating' => 5.0,
                'to_id' => 15,
                'to_type' => 'App\\Models\\Lawyer',
                'updated_at' => '2023-08-29 15:41:22',
            ),
            3 => 
            array (
                'booked_appointment_id' => 46,
                'comment' => 'good communication',
                'created_at' => '2023-10-12 13:44:19',
                'deleted_at' => NULL,
                'fromable_id' => 31,
                'fromable_type' => 'App\\Models\\Lawyer',
                'id' => 4,
                'rating' => 5.0,
                'to_id' => 4,
                'to_type' => 'App\\Models\\Customer',
                'updated_at' => '2023-10-12 13:44:19',
            ),
            4 => 
            array (
                'booked_appointment_id' => 46,
                'comment' => 'Helpful',
                'created_at' => '2023-10-12 13:46:52',
                'deleted_at' => NULL,
                'fromable_id' => 4,
                'fromable_type' => 'App\\Models\\Customer',
                'id' => 5,
                'rating' => 5.0,
                'to_id' => 31,
                'to_type' => 'App\\Models\\Lawyer',
                'updated_at' => '2023-10-12 13:46:52',
            ),
        ));
        
        
    }
}