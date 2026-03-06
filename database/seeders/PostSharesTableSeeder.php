<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PostSharesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('post_shares')->delete();
        
        \DB::table('post_shares')->insert(array (
            0 => 
            array (
                'created_at' => '2024-08-20 10:48:45',
                'deleted_at' => NULL,
                'id' => 1,
                'lawyer_id' => NULL,
                'post_id' => 151,
                'shared_with' => NULL,
                'updated_at' => '2024-08-20 10:48:45',
                'user_id' => NULL,
            ),
        ));
        
        
    }
}