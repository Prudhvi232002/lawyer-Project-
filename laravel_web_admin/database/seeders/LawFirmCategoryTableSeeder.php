<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LawFirmCategoryTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('law_firm_category')->delete();
        
        \DB::table('law_firm_category')->insert(array (
            0 => 
            array (
                'id' => 1,
                'law_firm_category_id' => 1,
                'law_firm_id' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'law_firm_category_id' => 1,
                'law_firm_id' => 3,
            ),
            2 => 
            array (
                'id' => 3,
                'law_firm_category_id' => 1,
                'law_firm_id' => 5,
            ),
            3 => 
            array (
                'id' => 4,
                'law_firm_category_id' => 1,
                'law_firm_id' => 6,
            ),
            4 => 
            array (
                'id' => 5,
                'law_firm_category_id' => 1,
                'law_firm_id' => 9,
            ),
            5 => 
            array (
                'id' => 6,
                'law_firm_category_id' => 1,
                'law_firm_id' => 11,
            ),
            6 => 
            array (
                'id' => 7,
                'law_firm_category_id' => 1,
                'law_firm_id' => 14,
            ),
        ));
        
        
    }
}