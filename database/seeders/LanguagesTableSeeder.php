<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LanguagesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('languages')->delete();
        
        \DB::table('languages')->insert(array (
            0 => 
            array (
                'code' => 'en',
                'country_code' => 'US',
                'created_at' => '2021-09-08 12:15:06',
                'deleted_at' => NULL,
                'description' => '<p>English</p>',
                'id' => 4,
                'image' => NULL,
                'is_active' => 1,
                'is_default' => 1,
                'name' => 'English',
                'updated_at' => '2023-01-16 14:59:30',
            ),
            1 => 
            array (
                'code' => 'hi',
                'country_code' => 'IN',
                'created_at' => '2023-10-05 18:14:06',
                'deleted_at' => NULL,
                'description' => '<p>Hindi Language&nbsp;</p>',
                'id' => 16,
                'image' => NULL,
                'is_active' => 1,
                'is_default' => 0,
                'name' => 'Hindi',
                'updated_at' => '2023-10-05 18:14:06',
            ),
            2 => 
            array (
                'code' => 'ar',
                'country_code' => 'AE',
                'created_at' => '2023-10-05 18:15:02',
                'deleted_at' => NULL,
                'description' => '<p>Arabic Language&nbsp;</p>',
                'id' => 17,
                'image' => NULL,
                'is_active' => 1,
                'is_default' => 0,
                'name' => 'Arabic',
                'updated_at' => '2023-10-05 18:15:02',
            ),
        ));
        
        
    }
}