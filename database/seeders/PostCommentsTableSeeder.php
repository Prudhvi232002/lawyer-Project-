<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PostCommentsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('post_comments')->delete();
        
        \DB::table('post_comments')->insert(array (
            0 => 
            array (
                'content' => 'Excellent Post Man',
                'created_at' => '2024-08-15 11:40:08',
                'deleted_at' => NULL,
                'id' => 1,
                'is_like' => 1,
                'lawyer_id' => 21,
                'parent_id' => NULL,
                'post_id' => 10,
                'updated_at' => '2024-08-16 11:16:16',
                'user_id' => 21,
            ),
            1 => 
            array (
                'content' => 'Comment somethimng',
                'created_at' => '2024-08-16 06:15:34',
                'deleted_at' => NULL,
                'id' => 2,
                'is_like' => 0,
                'lawyer_id' => 17,
                'parent_id' => NULL,
                'post_id' => 8,
                'updated_at' => '2024-08-16 11:16:11',
                'user_id' => 17,
            ),
            2 => 
            array (
                'content' => 'Comment for Real Estate Law',
                'created_at' => '2024-08-16 06:28:02',
                'deleted_at' => NULL,
                'id' => 3,
                'is_like' => 0,
                'lawyer_id' => NULL,
                'parent_id' => NULL,
                'post_id' => 9,
                'updated_at' => '2024-08-16 06:28:02',
                'user_id' => 17,
            ),
            3 => 
            array (
                'content' => 'This Comment for Real law advisor',
                'created_at' => '2024-08-16 06:29:43',
                'deleted_at' => NULL,
                'id' => 4,
                'is_like' => 0,
                'lawyer_id' => NULL,
                'parent_id' => NULL,
                'post_id' => 11,
                'updated_at' => '2024-08-16 06:29:43',
                'user_id' => 17,
            ),
            4 => 
            array (
                'content' => 'comment for A Guide to Special Education Law',
                'created_at' => '2024-08-16 06:34:28',
                'deleted_at' => NULL,
                'id' => 5,
                'is_like' => 0,
                'lawyer_id' => NULL,
                'parent_id' => NULL,
                'post_id' => 12,
                'updated_at' => '2024-08-16 06:34:28',
                'user_id' => 17,
            ),
            5 => 
            array (
                'content' => 'comment for Balancing Rights and Responsibilities',
                'created_at' => '2024-08-16 06:37:16',
                'deleted_at' => NULL,
                'id' => 6,
                'is_like' => 0,
                'lawyer_id' => NULL,
                'parent_id' => NULL,
                'post_id' => 13,
                'updated_at' => '2024-08-16 06:37:16',
                'user_id' => 17,
            ),
            6 => 
            array (
                'content' => 'comment for Balancing Rights and Responsibilities',
                'created_at' => '2024-08-16 06:38:10',
                'deleted_at' => NULL,
                'id' => 7,
                'is_like' => 0,
                'lawyer_id' => NULL,
                'parent_id' => NULL,
                'post_id' => 13,
                'updated_at' => '2024-08-16 06:38:10',
                'user_id' => 17,
            ),
            7 => 
            array (
                'content' => 'Another Comment',
                'created_at' => '2024-08-16 06:39:30',
                'deleted_at' => NULL,
                'id' => 8,
                'is_like' => 0,
                'lawyer_id' => NULL,
                'parent_id' => NULL,
                'post_id' => 8,
                'updated_at' => '2024-08-16 06:39:30',
                'user_id' => 17,
            ),
            8 => 
            array (
                'content' => 'comment for  A Guide to Special Education Law',
                'created_at' => '2024-08-16 06:48:45',
                'deleted_at' => NULL,
                'id' => 9,
                'is_like' => 0,
                'lawyer_id' => NULL,
                'parent_id' => NULL,
                'post_id' => 20,
                'updated_at' => '2024-08-16 06:48:45',
                'user_id' => 17,
            ),
            9 => 
            array (
                'content' => 'testing',
                'created_at' => '2024-08-16 07:16:27',
                'deleted_at' => NULL,
                'id' => 11,
                'is_like' => 0,
                'lawyer_id' => NULL,
                'parent_id' => NULL,
                'post_id' => 8,
                'updated_at' => '2024-08-16 07:16:27',
                'user_id' => 17,
            ),
            10 => 
            array (
                'content' => 'Testing',
                'created_at' => '2024-08-19 06:57:42',
                'deleted_at' => NULL,
                'id' => 12,
                'is_like' => 0,
                'lawyer_id' => NULL,
                'parent_id' => NULL,
                'post_id' => 143,
                'updated_at' => '2024-08-19 06:57:42',
                'user_id' => 17,
            ),
            11 => 
            array (
                'content' => 'Onw',
                'created_at' => '2024-08-19 10:20:57',
                'deleted_at' => NULL,
                'id' => 13,
                'is_like' => 0,
                'lawyer_id' => NULL,
                'parent_id' => NULL,
                'post_id' => 151,
                'updated_at' => '2024-08-19 10:20:57',
                'user_id' => 17,
            ),
            12 => 
            array (
                'content' => 'This is Reply Message ',
                'created_at' => '2024-08-19 10:20:57',
                'deleted_at' => NULL,
                'id' => 14,
                'is_like' => 0,
                'lawyer_id' => NULL,
                'parent_id' => 13,
                'post_id' => 151,
                'updated_at' => '2024-08-19 10:20:57',
                'user_id' => 17,
            ),
            13 => 
            array (
                'content' => 'Hello',
                'created_at' => '2024-08-20 06:36:09',
                'deleted_at' => NULL,
                'id' => 15,
                'is_like' => 0,
                'lawyer_id' => NULL,
                'parent_id' => NULL,
                'post_id' => 151,
                'updated_at' => '2024-08-20 06:36:09',
                'user_id' => 17,
            ),
            14 => 
            array (
                'content' => 'This is another Reply Message ',
                'created_at' => '2024-08-19 10:20:57',
                'deleted_at' => NULL,
                'id' => 16,
                'is_like' => 0,
                'lawyer_id' => NULL,
                'parent_id' => 13,
                'post_id' => 151,
                'updated_at' => '2024-08-19 10:20:57',
                'user_id' => 17,
            ),
            15 => 
            array (
                'content' => 'Automatically reply recorded',
                'created_at' => '2024-08-20 07:42:00',
                'deleted_at' => NULL,
                'id' => 20,
                'is_like' => 0,
                'lawyer_id' => NULL,
                'parent_id' => 13,
                'post_id' => 151,
                'updated_at' => '2024-08-20 07:42:00',
                'user_id' => 17,
            ),
            16 => 
            array (
                'content' => 'Hello There',
                'created_at' => '2024-08-20 07:44:33',
                'deleted_at' => NULL,
                'id' => 21,
                'is_like' => 0,
                'lawyer_id' => NULL,
                'parent_id' => 15,
                'post_id' => 151,
                'updated_at' => '2024-08-20 07:44:33',
                'user_id' => 17,
            ),
            17 => 
            array (
                'content' => 'Comment recorded',
                'created_at' => '2024-08-20 07:49:33',
                'deleted_at' => NULL,
                'id' => 22,
                'is_like' => 0,
                'lawyer_id' => NULL,
                'parent_id' => NULL,
                'post_id' => 149,
                'updated_at' => '2024-08-20 07:49:33',
                'user_id' => 17,
            ),
            18 => 
            array (
                'content' => 'Another Comment',
                'created_at' => '2024-08-20 07:51:17',
                'deleted_at' => NULL,
                'id' => 23,
                'is_like' => 0,
                'lawyer_id' => NULL,
                'parent_id' => NULL,
                'post_id' => 149,
                'updated_at' => '2024-08-20 07:51:17',
                'user_id' => 17,
            ),
            19 => 
            array (
                'content' => 'Comment',
                'created_at' => '2024-08-20 07:52:40',
                'deleted_at' => NULL,
                'id' => 24,
                'is_like' => 0,
                'lawyer_id' => NULL,
                'parent_id' => NULL,
                'post_id' => 151,
                'updated_at' => '2024-08-20 07:52:40',
                'user_id' => 17,
            ),
            20 => 
            array (
                'content' => 'ewplyyyyyyyyy',
                'created_at' => '2024-08-20 07:58:16',
                'deleted_at' => NULL,
                'id' => 25,
                'is_like' => 0,
                'lawyer_id' => NULL,
                'parent_id' => 24,
                'post_id' => 151,
                'updated_at' => '2024-08-20 07:58:16',
                'user_id' => 17,
            ),
            21 => 
            array (
                'content' => 'commentttttttt',
                'created_at' => '2024-08-20 08:00:36',
                'deleted_at' => NULL,
                'id' => 26,
                'is_like' => 0,
                'lawyer_id' => NULL,
                'parent_id' => NULL,
                'post_id' => 146,
                'updated_at' => '2024-08-20 08:00:36',
                'user_id' => 17,
            ),
            22 => 
            array (
                'content' => 'another reply',
                'created_at' => '2024-08-20 08:00:54',
                'deleted_at' => NULL,
                'id' => 27,
                'is_like' => 0,
                'lawyer_id' => NULL,
                'parent_id' => 26,
                'post_id' => 146,
                'updated_at' => '2024-08-20 08:00:54',
                'user_id' => 17,
            ),
        ));
        
        
    }
}