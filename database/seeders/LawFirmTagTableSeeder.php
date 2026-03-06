<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LawFirmTagTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('law_firm_tag')->delete();
        
        \DB::table('law_firm_tag')->insert(array (
            0 => 
            array (
                'id' => 1,
                'law_firm_id' => 5,
                'tag_id' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'law_firm_id' => 5,
                'tag_id' => 3,
            ),
            2 => 
            array (
                'id' => 3,
                'law_firm_id' => 3,
                'tag_id' => 4,
            ),
            3 => 
            array (
                'id' => 4,
                'law_firm_id' => 3,
                'tag_id' => 5,
            ),
            4 => 
            array (
                'id' => 5,
                'law_firm_id' => 3,
                'tag_id' => 3,
            ),
            5 => 
            array (
                'id' => 6,
                'law_firm_id' => 11,
                'tag_id' => 1,
            ),
            6 => 
            array (
                'id' => 7,
                'law_firm_id' => 11,
                'tag_id' => 4,
            ),
            7 => 
            array (
                'id' => 8,
                'law_firm_id' => 11,
                'tag_id' => 3,
            ),
            8 => 
            array (
                'id' => 9,
                'law_firm_id' => 11,
                'tag_id' => 5,
            ),
            9 => 
            array (
                'id' => 10,
                'law_firm_id' => 11,
                'tag_id' => 6,
            ),
        ));
        
        
    }
}