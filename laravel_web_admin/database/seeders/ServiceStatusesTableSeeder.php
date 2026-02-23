<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ServiceStatusesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('service_statuses')->delete();
        
        \DB::table('service_statuses')->insert(array (
            0 => 
            array (
                'created_at' => '2023-05-29 21:22:47',
                'deleted_at' => NULL,
                'description' => 'Pending',
                'display_name' => 'Pending',
                'id' => 1,
                'is_active' => 1,
                'status_code' => 1,
                'updated_at' => '2023-05-29 21:22:47',
            ),
            1 => 
            array (
                'created_at' => '2023-05-29 21:24:39',
                'deleted_at' => NULL,
                'description' => 'Accepted',
                'display_name' => 'Accepted',
                'id' => 2,
                'is_active' => 1,
                'status_code' => 2,
                'updated_at' => '2023-05-29 21:24:39',
            ),
            2 => 
            array (
                'created_at' => '2023-05-29 21:24:56',
                'deleted_at' => NULL,
                'description' => 'Rejected',
                'display_name' => 'Rejected',
                'id' => 3,
                'is_active' => 1,
                'status_code' => 3,
                'updated_at' => '2023-05-29 21:24:56',
            ),
            3 => 
            array (
                'created_at' => '2023-05-29 21:25:18',
                'deleted_at' => NULL,
                'description' => 'Cancelled',
                'display_name' => 'Cancelled',
                'id' => 4,
                'is_active' => 1,
                'status_code' => 4,
                'updated_at' => '2023-05-29 21:25:18',
            ),
            4 => 
            array (
                'created_at' => '2023-06-03 18:04:25',
                'deleted_at' => NULL,
                'description' => 'Completed',
                'display_name' => 'Completed',
                'id' => 5,
                'is_active' => 1,
                'status_code' => 5,
                'updated_at' => '2023-06-03 18:04:25',
            ),
        ));
        
        
    }
}