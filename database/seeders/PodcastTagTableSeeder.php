<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PodcastTagTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('podcast_tag')->delete();
        
        \DB::table('podcast_tag')->insert(array (
            0 => 
            array (
                'id' => 24,
                'podcast_id' => 16,
                'tag_id' => 3,
            ),
            1 => 
            array (
                'id' => 25,
                'podcast_id' => 16,
                'tag_id' => 1,
            ),
            2 => 
            array (
                'id' => 26,
                'podcast_id' => 16,
                'tag_id' => 5,
            ),
            3 => 
            array (
                'id' => 27,
                'podcast_id' => 17,
                'tag_id' => 3,
            ),
            4 => 
            array (
                'id' => 28,
                'podcast_id' => 17,
                'tag_id' => 1,
            ),
            5 => 
            array (
                'id' => 29,
                'podcast_id' => 17,
                'tag_id' => 6,
            ),
            6 => 
            array (
                'id' => 30,
                'podcast_id' => 17,
                'tag_id' => 4,
            ),
            7 => 
            array (
                'id' => 31,
                'podcast_id' => 18,
                'tag_id' => 1,
            ),
            8 => 
            array (
                'id' => 32,
                'podcast_id' => 18,
                'tag_id' => 3,
            ),
            9 => 
            array (
                'id' => 33,
                'podcast_id' => 18,
                'tag_id' => 5,
            ),
            10 => 
            array (
                'id' => 34,
                'podcast_id' => 18,
                'tag_id' => 6,
            ),
            11 => 
            array (
                'id' => 35,
                'podcast_id' => 19,
                'tag_id' => 3,
            ),
            12 => 
            array (
                'id' => 36,
                'podcast_id' => 19,
                'tag_id' => 1,
            ),
            13 => 
            array (
                'id' => 37,
                'podcast_id' => 19,
                'tag_id' => 5,
            ),
            14 => 
            array (
                'id' => 38,
                'podcast_id' => 19,
                'tag_id' => 4,
            ),
            15 => 
            array (
                'id' => 39,
                'podcast_id' => 144,
                'tag_id' => 1,
            ),
            16 => 
            array (
                'id' => 40,
                'podcast_id' => 144,
                'tag_id' => 4,
            ),
            17 => 
            array (
                'id' => 41,
                'podcast_id' => 144,
                'tag_id' => 5,
            ),
            18 => 
            array (
                'id' => 42,
                'podcast_id' => 144,
                'tag_id' => 3,
            ),
            19 => 
            array (
                'id' => 43,
                'podcast_id' => 144,
                'tag_id' => 6,
            ),
            20 => 
            array (
                'id' => 44,
                'podcast_id' => 145,
                'tag_id' => 3,
            ),
            21 => 
            array (
                'id' => 45,
                'podcast_id' => 145,
                'tag_id' => 1,
            ),
            22 => 
            array (
                'id' => 46,
                'podcast_id' => 145,
                'tag_id' => 5,
            ),
            23 => 
            array (
                'id' => 47,
                'podcast_id' => 145,
                'tag_id' => 4,
            ),
            24 => 
            array (
                'id' => 48,
                'podcast_id' => 145,
                'tag_id' => 6,
            ),
            25 => 
            array (
                'id' => 49,
                'podcast_id' => 146,
                'tag_id' => 1,
            ),
            26 => 
            array (
                'id' => 50,
                'podcast_id' => 146,
                'tag_id' => 3,
            ),
            27 => 
            array (
                'id' => 51,
                'podcast_id' => 146,
                'tag_id' => 4,
            ),
            28 => 
            array (
                'id' => 52,
                'podcast_id' => 146,
                'tag_id' => 5,
            ),
            29 => 
            array (
                'id' => 53,
                'podcast_id' => 146,
                'tag_id' => 6,
            ),
            30 => 
            array (
                'id' => 54,
                'podcast_id' => 147,
                'tag_id' => 3,
            ),
            31 => 
            array (
                'id' => 55,
                'podcast_id' => 147,
                'tag_id' => 1,
            ),
            32 => 
            array (
                'id' => 56,
                'podcast_id' => 147,
                'tag_id' => 5,
            ),
            33 => 
            array (
                'id' => 57,
                'podcast_id' => 147,
                'tag_id' => 4,
            ),
        ));
        
        
    }
}