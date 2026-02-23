<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OauthPersonalAccessClientsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('oauth_personal_access_clients')->delete();
        
        \DB::table('oauth_personal_access_clients')->insert(array (
            0 => 
            array (
                'client_id' => 1,
                'created_at' => '2023-03-27 17:51:11',
                'id' => 1,
                'updated_at' => '2023-03-27 17:51:11',
            ),
            1 => 
            array (
                'client_id' => 3,
                'created_at' => '2023-04-29 15:55:56',
                'id' => 2,
                'updated_at' => '2023-04-29 15:55:56',
            ),
        ));
        
        
    }
}