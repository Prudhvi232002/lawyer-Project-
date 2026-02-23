<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PostTagTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('post_tag')->delete();
        
        \DB::table('post_tag')->insert(array (
            0 => 
            array (
                'id' => 14,
                'post_id' => 18,
                'tag_id' => 4,
            ),
            1 => 
            array (
                'id' => 15,
                'post_id' => 18,
                'tag_id' => 6,
            ),
            2 => 
            array (
                'id' => 16,
                'post_id' => 18,
                'tag_id' => 3,
            ),
            3 => 
            array (
                'id' => 17,
                'post_id' => 20,
                'tag_id' => 3,
            ),
            4 => 
            array (
                'id' => 18,
                'post_id' => 20,
                'tag_id' => 4,
            ),
            5 => 
            array (
                'id' => 19,
                'post_id' => 20,
                'tag_id' => 6,
            ),
            6 => 
            array (
                'id' => 20,
                'post_id' => 20,
                'tag_id' => 1,
            ),
            7 => 
            array (
                'id' => 21,
                'post_id' => 21,
                'tag_id' => 3,
            ),
            8 => 
            array (
                'id' => 22,
                'post_id' => 21,
                'tag_id' => 4,
            ),
            9 => 
            array (
                'id' => 23,
                'post_id' => 21,
                'tag_id' => 5,
            ),
            10 => 
            array (
                'id' => 24,
                'post_id' => 21,
                'tag_id' => 6,
            ),
            11 => 
            array (
                'id' => 25,
                'post_id' => 131,
                'tag_id' => 1,
            ),
            12 => 
            array (
                'id' => 26,
                'post_id' => 131,
                'tag_id' => 3,
            ),
            13 => 
            array (
                'id' => 27,
                'post_id' => 131,
                'tag_id' => 4,
            ),
            14 => 
            array (
                'id' => 28,
                'post_id' => 131,
                'tag_id' => 5,
            ),
            15 => 
            array (
                'id' => 29,
                'post_id' => 131,
                'tag_id' => 6,
            ),
            16 => 
            array (
                'id' => 30,
                'post_id' => 132,
                'tag_id' => 3,
            ),
            17 => 
            array (
                'id' => 31,
                'post_id' => 132,
                'tag_id' => 1,
            ),
            18 => 
            array (
                'id' => 32,
                'post_id' => 132,
                'tag_id' => 4,
            ),
            19 => 
            array (
                'id' => 33,
                'post_id' => 132,
                'tag_id' => 5,
            ),
            20 => 
            array (
                'id' => 34,
                'post_id' => 132,
                'tag_id' => 6,
            ),
        ));
        
        
    }
}