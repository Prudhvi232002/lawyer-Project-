<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LawyerLanguageTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('lawyer_language')->delete();
        
        \DB::table('lawyer_language')->insert(array (
            0 => 
            array (
                'all_language_id' => 1,
                'id' => 2,
                'lawyer_id' => 21,
            ),
            1 => 
            array (
                'all_language_id' => 1,
                'id' => 3,
                'lawyer_id' => 23,
            ),
            2 => 
            array (
                'all_language_id' => 12,
                'id' => 4,
                'lawyer_id' => 22,
            ),
            3 => 
            array (
                'all_language_id' => 1,
                'id' => 5,
                'lawyer_id' => 22,
            ),
            4 => 
            array (
                'all_language_id' => 7,
                'id' => 6,
                'lawyer_id' => 22,
            ),
            5 => 
            array (
                'all_language_id' => 16,
                'id' => 7,
                'lawyer_id' => 22,
            ),
            6 => 
            array (
                'all_language_id' => 1,
                'id' => 8,
                'lawyer_id' => 28,
            ),
            7 => 
            array (
                'all_language_id' => 6,
                'id' => 9,
                'lawyer_id' => 28,
            ),
            8 => 
            array (
                'all_language_id' => 42,
                'id' => 10,
                'lawyer_id' => 28,
            ),
            9 => 
            array (
                'all_language_id' => 1,
                'id' => 11,
                'lawyer_id' => 27,
            ),
            10 => 
            array (
                'all_language_id' => 18,
                'id' => 15,
                'lawyer_id' => 25,
            ),
            11 => 
            array (
                'all_language_id' => 1,
                'id' => 16,
                'lawyer_id' => 25,
            ),
            12 => 
            array (
                'all_language_id' => 127,
                'id' => 17,
                'lawyer_id' => 25,
            ),
            13 => 
            array (
                'all_language_id' => 6,
                'id' => 18,
                'lawyer_id' => 25,
            ),
            14 => 
            array (
                'all_language_id' => 11,
                'id' => 19,
                'lawyer_id' => 26,
            ),
            15 => 
            array (
                'all_language_id' => 23,
                'id' => 20,
                'lawyer_id' => 26,
            ),
            16 => 
            array (
                'all_language_id' => 36,
                'id' => 21,
                'lawyer_id' => 26,
            ),
            17 => 
            array (
                'all_language_id' => 48,
                'id' => 22,
                'lawyer_id' => 26,
            ),
            18 => 
            array (
                'all_language_id' => 1,
                'id' => 23,
                'lawyer_id' => 26,
            ),
            19 => 
            array (
                'all_language_id' => 1,
                'id' => 24,
                'lawyer_id' => 2,
            ),
            20 => 
            array (
                'all_language_id' => 1,
                'id' => 25,
                'lawyer_id' => 8,
            ),
            21 => 
            array (
                'all_language_id' => 4,
                'id' => 26,
                'lawyer_id' => 8,
            ),
            22 => 
            array (
                'all_language_id' => 3,
                'id' => 27,
                'lawyer_id' => 13,
            ),
            23 => 
            array (
                'all_language_id' => 1,
                'id' => 28,
                'lawyer_id' => 13,
            ),
            24 => 
            array (
                'all_language_id' => 1,
                'id' => 29,
                'lawyer_id' => 14,
            ),
            25 => 
            array (
                'all_language_id' => 6,
                'id' => 30,
                'lawyer_id' => 14,
            ),
            26 => 
            array (
                'all_language_id' => 42,
                'id' => 31,
                'lawyer_id' => 14,
            ),
            27 => 
            array (
                'all_language_id' => 1,
                'id' => 32,
                'lawyer_id' => 11,
            ),
            28 => 
            array (
                'all_language_id' => 6,
                'id' => 33,
                'lawyer_id' => 11,
            ),
            29 => 
            array (
                'all_language_id' => 42,
                'id' => 34,
                'lawyer_id' => 11,
            ),
            30 => 
            array (
                'all_language_id' => 1,
                'id' => 35,
                'lawyer_id' => 30,
            ),
            31 => 
            array (
                'all_language_id' => 1,
                'id' => 36,
                'lawyer_id' => 29,
            ),
            32 => 
            array (
                'all_language_id' => 42,
                'id' => 37,
                'lawyer_id' => 29,
            ),
            33 => 
            array (
                'all_language_id' => 6,
                'id' => 38,
                'lawyer_id' => 29,
            ),
            34 => 
            array (
                'all_language_id' => 1,
                'id' => 39,
                'lawyer_id' => 33,
            ),
            35 => 
            array (
                'all_language_id' => 1,
                'id' => 42,
                'lawyer_id' => 9,
            ),
            36 => 
            array (
                'all_language_id' => 6,
                'id' => 43,
                'lawyer_id' => 9,
            ),
            37 => 
            array (
                'all_language_id' => 42,
                'id' => 44,
                'lawyer_id' => 9,
            ),
            38 => 
            array (
                'all_language_id' => 1,
                'id' => 45,
                'lawyer_id' => 15,
            ),
            39 => 
            array (
                'all_language_id' => 1,
                'id' => 46,
                'lawyer_id' => 37,
            ),
            40 => 
            array (
                'all_language_id' => 1,
                'id' => 47,
                'lawyer_id' => 80,
            ),
        ));
        
        
    }
}