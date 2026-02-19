<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CurrenciesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('currencies')->delete();
        
        \DB::table('currencies')->insert(array (
            0 => 
            array (
                'code' => 'AUD',
                'created_at' => '2021-03-19 06:57:02',
                'decimal_places' => 4,
                'direction' => 'ltr',
                'id' => 8,
                'is_active' => 1,
                'is_default' => 1,
                'name' => 'USA Dollar',
                'symbol' => '€',
                'updated_at' => '2024-01-09 15:27:32',
                'value' => 1.0,
            ),
        ));
        
        
    }
}