<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CommissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('commissions')->delete();
        
        \DB::table('commissions')->insert(array (
            0 => 
            array (
                'appointment_type_id' => 1,
                'commission_type' => 'percentage',
                'created_at' => '2024-05-14 12:59:08',
                'id' => 1,
                'rate' => 20.0,
                'service_type_id' => NULL,
                'updated_at' => '2024-05-14 12:59:08',
            ),
            1 => 
            array (
                'appointment_type_id' => 2,
                'commission_type' => 'fixed_rate',
                'created_at' => '2024-05-14 12:59:08',
                'id' => 2,
                'rate' => 20.0,
                'service_type_id' => NULL,
                'updated_at' => '2024-05-14 12:59:08',
            ),
            2 => 
            array (
                'appointment_type_id' => 3,
                'commission_type' => 'fixed_rate',
                'created_at' => '2024-05-14 12:59:08',
                'id' => 3,
                'rate' => 20.0,
                'service_type_id' => NULL,
                'updated_at' => '2024-05-14 12:59:08',
            ),
        ));
        
        
    }
}