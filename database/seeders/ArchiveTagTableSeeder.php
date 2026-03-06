<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ArchiveTagTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('archive_tag')->delete();
        
        \DB::table('archive_tag')->insert(array (
            0 => 
            array (
                'archive_id' => 8,
                'id' => 6,
                'tag_id' => 3,
            ),
            1 => 
            array (
                'archive_id' => 8,
                'id' => 7,
                'tag_id' => 6,
            ),
            2 => 
            array (
                'archive_id' => 8,
                'id' => 8,
                'tag_id' => 1,
            ),
            3 => 
            array (
                'archive_id' => 8,
                'id' => 9,
                'tag_id' => 4,
            ),
            4 => 
            array (
                'archive_id' => 9,
                'id' => 10,
                'tag_id' => 3,
            ),
            5 => 
            array (
                'archive_id' => 10,
                'id' => 11,
                'tag_id' => 3,
            ),
            6 => 
            array (
                'archive_id' => 10,
                'id' => 12,
                'tag_id' => 1,
            ),
            7 => 
            array (
                'archive_id' => 10,
                'id' => 13,
                'tag_id' => 5,
            ),
            8 => 
            array (
                'archive_id' => 10,
                'id' => 14,
                'tag_id' => 4,
            ),
            9 => 
            array (
                'archive_id' => 11,
                'id' => 15,
                'tag_id' => 3,
            ),
            10 => 
            array (
                'archive_id' => 11,
                'id' => 16,
                'tag_id' => 1,
            ),
            11 => 
            array (
                'archive_id' => 11,
                'id' => 17,
                'tag_id' => 5,
            ),
            12 => 
            array (
                'archive_id' => 11,
                'id' => 18,
                'tag_id' => 6,
            ),
            13 => 
            array (
                'archive_id' => 225,
                'id' => 19,
                'tag_id' => 3,
            ),
            14 => 
            array (
                'archive_id' => 225,
                'id' => 20,
                'tag_id' => 4,
            ),
            15 => 
            array (
                'archive_id' => 225,
                'id' => 21,
                'tag_id' => 1,
            ),
            16 => 
            array (
                'archive_id' => 225,
                'id' => 22,
                'tag_id' => 5,
            ),
            17 => 
            array (
                'archive_id' => 226,
                'id' => 23,
                'tag_id' => 3,
            ),
            18 => 
            array (
                'archive_id' => 226,
                'id' => 24,
                'tag_id' => 4,
            ),
            19 => 
            array (
                'archive_id' => 226,
                'id' => 25,
                'tag_id' => 1,
            ),
            20 => 
            array (
                'archive_id' => 226,
                'id' => 26,
                'tag_id' => 5,
            ),
            21 => 
            array (
                'archive_id' => 226,
                'id' => 27,
                'tag_id' => 6,
            ),
            22 => 
            array (
                'archive_id' => 227,
                'id' => 28,
                'tag_id' => 3,
            ),
            23 => 
            array (
                'archive_id' => 227,
                'id' => 29,
                'tag_id' => 1,
            ),
            24 => 
            array (
                'archive_id' => 227,
                'id' => 30,
                'tag_id' => 4,
            ),
            25 => 
            array (
                'archive_id' => 227,
                'id' => 31,
                'tag_id' => 5,
            ),
            26 => 
            array (
                'archive_id' => 227,
                'id' => 32,
                'tag_id' => 6,
            ),
        ));
        
        
    }
}