<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PostLikesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('post_likes')->delete();
        
        \DB::table('post_likes')->insert(array (
            0 => 
            array (
                'created_at' => '2024-08-15 12:18:45',
                'deleted_at' => NULL,
                'id' => 1,
                'is_like' => 0,
                'lawyer_id' => 15,
                'post_id' => 10,
                'updated_at' => '2024-08-16 06:47:52',
                'user_id' => NULL,
            ),
            1 => 
            array (
                'created_at' => '2024-08-15 12:18:45',
                'deleted_at' => NULL,
                'id' => 2,
                'is_like' => 1,
                'lawyer_id' => 21,
                'post_id' => 10,
                'updated_at' => '2024-08-15 12:36:41',
                'user_id' => NULL,
            ),
            2 => 
            array (
                'created_at' => '2024-08-15 08:18:44',
                'deleted_at' => NULL,
                'id' => 3,
                'is_like' => 1,
                'lawyer_id' => 15,
                'post_id' => 10,
                'updated_at' => '2024-08-15 08:18:44',
                'user_id' => NULL,
            ),
            3 => 
            array (
                'created_at' => '2024-08-15 08:19:27',
                'deleted_at' => NULL,
                'id' => 4,
                'is_like' => 1,
                'lawyer_id' => 15,
                'post_id' => 11,
                'updated_at' => '2024-08-16 06:48:02',
                'user_id' => NULL,
            ),
            4 => 
            array (
                'created_at' => '2024-08-15 08:25:25',
                'deleted_at' => NULL,
                'id' => 5,
                'is_like' => 1,
                'lawyer_id' => 17,
                'post_id' => 8,
                'updated_at' => '2024-08-15 12:26:46',
                'user_id' => NULL,
            ),
            5 => 
            array (
                'created_at' => '2024-08-15 08:25:31',
                'deleted_at' => NULL,
                'id' => 6,
                'is_like' => 1,
                'lawyer_id' => 15,
                'post_id' => 10,
                'updated_at' => '2024-08-15 08:25:31',
                'user_id' => NULL,
            ),
            6 => 
            array (
                'created_at' => '2024-08-15 08:48:55',
                'deleted_at' => NULL,
                'id' => 7,
                'is_like' => 1,
                'lawyer_id' => 21,
                'post_id' => 12,
                'updated_at' => '2024-08-15 11:32:39',
                'user_id' => NULL,
            ),
            7 => 
            array (
                'created_at' => '2024-08-15 09:06:52',
                'deleted_at' => NULL,
                'id' => 8,
                'is_like' => 0,
                'lawyer_id' => 21,
                'post_id' => 14,
                'updated_at' => '2024-08-16 06:48:18',
                'user_id' => 17,
            ),
            8 => 
            array (
                'created_at' => '2024-08-15 09:07:03',
                'deleted_at' => NULL,
                'id' => 9,
                'is_like' => 1,
                'lawyer_id' => 17,
                'post_id' => 9,
                'updated_at' => '2024-08-16 06:46:22',
                'user_id' => NULL,
            ),
            9 => 
            array (
                'created_at' => '2024-08-15 11:32:55',
                'deleted_at' => NULL,
                'id' => 10,
                'is_like' => 1,
                'lawyer_id' => 21,
                'post_id' => 13,
                'updated_at' => '2024-08-15 11:32:55',
                'user_id' => NULL,
            ),
            10 => 
            array (
                'created_at' => '2024-08-15 11:33:09',
                'deleted_at' => NULL,
                'id' => 11,
                'is_like' => 1,
                'lawyer_id' => 14,
                'post_id' => 18,
                'updated_at' => '2024-08-15 11:33:09',
                'user_id' => NULL,
            ),
            11 => 
            array (
                'created_at' => '2024-08-16 06:48:23',
                'deleted_at' => NULL,
                'id' => 12,
                'is_like' => 1,
                'lawyer_id' => 14,
                'post_id' => 20,
                'updated_at' => '2024-08-16 06:48:23',
                'user_id' => NULL,
            ),
            12 => 
            array (
                'created_at' => '2024-08-19 10:20:48',
                'deleted_at' => NULL,
                'id' => 13,
                'is_like' => 1,
                'lawyer_id' => 15,
                'post_id' => 151,
                'updated_at' => '2024-08-19 10:20:48',
                'user_id' => NULL,
            ),
        ));
        
        
    }
}