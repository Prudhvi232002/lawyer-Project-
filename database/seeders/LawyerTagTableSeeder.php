<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LawyerTagTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('lawyer_tag')->delete();
        
        \DB::table('lawyer_tag')->insert(array (
            0 => 
            array (
                'id' => 2,
                'lawyer_id' => 21,
                'tag_id' => 1,
            ),
            1 => 
            array (
                'id' => 3,
                'lawyer_id' => 23,
                'tag_id' => 1,
            ),
            2 => 
            array (
                'id' => 4,
                'lawyer_id' => 23,
                'tag_id' => 3,
            ),
            3 => 
            array (
                'id' => 5,
                'lawyer_id' => 22,
                'tag_id' => 3,
            ),
            4 => 
            array (
                'id' => 6,
                'lawyer_id' => 28,
                'tag_id' => 3,
            ),
            5 => 
            array (
                'id' => 7,
                'lawyer_id' => 28,
                'tag_id' => 1,
            ),
            6 => 
            array (
                'id' => 8,
                'lawyer_id' => 27,
                'tag_id' => 1,
            ),
            7 => 
            array (
                'id' => 10,
                'lawyer_id' => 25,
                'tag_id' => 3,
            ),
            8 => 
            array (
                'id' => 11,
                'lawyer_id' => 26,
                'tag_id' => 3,
            ),
            9 => 
            array (
                'id' => 12,
                'lawyer_id' => 26,
                'tag_id' => 1,
            ),
            10 => 
            array (
                'id' => 13,
                'lawyer_id' => 2,
                'tag_id' => 1,
            ),
            11 => 
            array (
                'id' => 14,
                'lawyer_id' => 2,
                'tag_id' => 3,
            ),
            12 => 
            array (
                'id' => 15,
                'lawyer_id' => 8,
                'tag_id' => 1,
            ),
            13 => 
            array (
                'id' => 16,
                'lawyer_id' => 8,
                'tag_id' => 3,
            ),
            14 => 
            array (
                'id' => 17,
                'lawyer_id' => 13,
                'tag_id' => 1,
            ),
            15 => 
            array (
                'id' => 18,
                'lawyer_id' => 13,
                'tag_id' => 3,
            ),
            16 => 
            array (
                'id' => 19,
                'lawyer_id' => 14,
                'tag_id' => 1,
            ),
            17 => 
            array (
                'id' => 20,
                'lawyer_id' => 14,
                'tag_id' => 4,
            ),
            18 => 
            array (
                'id' => 21,
                'lawyer_id' => 14,
                'tag_id' => 5,
            ),
            19 => 
            array (
                'id' => 22,
                'lawyer_id' => 14,
                'tag_id' => 3,
            ),
            20 => 
            array (
                'id' => 23,
                'lawyer_id' => 14,
                'tag_id' => 6,
            ),
            21 => 
            array (
                'id' => 24,
                'lawyer_id' => 11,
                'tag_id' => 1,
            ),
            22 => 
            array (
                'id' => 25,
                'lawyer_id' => 11,
                'tag_id' => 3,
            ),
            23 => 
            array (
                'id' => 26,
                'lawyer_id' => 11,
                'tag_id' => 5,
            ),
            24 => 
            array (
                'id' => 27,
                'lawyer_id' => 11,
                'tag_id' => 6,
            ),
            25 => 
            array (
                'id' => 28,
                'lawyer_id' => 11,
                'tag_id' => 4,
            ),
            26 => 
            array (
                'id' => 29,
                'lawyer_id' => 30,
                'tag_id' => 1,
            ),
            27 => 
            array (
                'id' => 32,
                'lawyer_id' => 29,
                'tag_id' => 3,
            ),
            28 => 
            array (
                'id' => 33,
                'lawyer_id' => 29,
                'tag_id' => 5,
            ),
            29 => 
            array (
                'id' => 34,
                'lawyer_id' => 29,
                'tag_id' => 1,
            ),
            30 => 
            array (
                'id' => 38,
                'lawyer_id' => 9,
                'tag_id' => 3,
            ),
            31 => 
            array (
                'id' => 39,
                'lawyer_id' => 9,
                'tag_id' => 1,
            ),
            32 => 
            array (
                'id' => 40,
                'lawyer_id' => 9,
                'tag_id' => 4,
            ),
            33 => 
            array (
                'id' => 41,
                'lawyer_id' => 9,
                'tag_id' => 5,
            ),
            34 => 
            array (
                'id' => 42,
                'lawyer_id' => 9,
                'tag_id' => 6,
            ),
            35 => 
            array (
                'id' => 43,
                'lawyer_id' => 33,
                'tag_id' => 1,
            ),
            36 => 
            array (
                'id' => 44,
                'lawyer_id' => 15,
                'tag_id' => 1,
            ),
            37 => 
            array (
                'id' => 45,
                'lawyer_id' => 37,
                'tag_id' => 1,
            ),
            38 => 
            array (
                'id' => 46,
                'lawyer_id' => 37,
                'tag_id' => 3,
            ),
            39 => 
            array (
                'id' => 47,
                'lawyer_id' => 37,
                'tag_id' => 4,
            ),
            40 => 
            array (
                'id' => 48,
                'lawyer_id' => 37,
                'tag_id' => 5,
            ),
            41 => 
            array (
                'id' => 49,
                'lawyer_id' => 37,
                'tag_id' => 6,
            ),
            42 => 
            array (
                'id' => 50,
                'lawyer_id' => 80,
                'tag_id' => 1,
            ),
            43 => 
            array (
                'id' => 51,
                'lawyer_id' => 80,
                'tag_id' => 4,
            ),
            44 => 
            array (
                'id' => 52,
                'lawyer_id' => 80,
                'tag_id' => 6,
            ),
            45 => 
            array (
                'id' => 53,
                'lawyer_id' => 80,
                'tag_id' => 5,
            ),
            46 => 
            array (
                'id' => 54,
                'lawyer_id' => 80,
                'tag_id' => 3,
            ),
        ));
        
        
    }
}