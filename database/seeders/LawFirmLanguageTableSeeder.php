<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LawFirmLanguageTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('law_firm_language')->delete();
        
        \DB::table('law_firm_language')->insert(array (
            0 => 
            array (
                'all_language_id' => 1,
                'id' => 1,
                'law_firm_id' => 5,
            ),
            1 => 
            array (
                'all_language_id' => 1,
                'id' => 2,
                'law_firm_id' => 3,
            ),
            2 => 
            array (
                'all_language_id' => 2,
                'id' => 3,
                'law_firm_id' => 3,
            ),
            3 => 
            array (
                'all_language_id' => 6,
                'id' => 4,
                'law_firm_id' => 11,
            ),
        ));
        
        
    }
}