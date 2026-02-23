<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OauthClientsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('oauth_clients')->delete();
        
        \DB::table('oauth_clients')->insert(array (
            0 => 
            array (
                'created_at' => '2023-03-27 17:51:11',
                'id' => 1,
                'name' => 'Global Healing Network Personal Access Client',
                'password_client' => 0,
                'personal_access_client' => 1,
                'provider' => NULL,
                'redirect' => 'http://localhost',
                'revoked' => 0,
                'secret' => 'g4d2I88QogIAoKrck1vobzPopUDEnEXawy82vuBj',
                'updated_at' => '2023-03-27 17:51:11',
                'user_id' => NULL,
            ),
            1 => 
            array (
                'created_at' => '2023-03-27 17:51:11',
                'id' => 2,
                'name' => 'Global Healing Network Password Grant Client',
                'password_client' => 1,
                'personal_access_client' => 0,
                'provider' => 'users',
                'redirect' => 'http://localhost',
                'revoked' => 0,
                'secret' => 'e52LYY9p3PWHNhemnHcivx5Y1Nfo27EzdZlZyAcj',
                'updated_at' => '2023-03-27 17:51:11',
                'user_id' => NULL,
            ),
            2 => 
            array (
                'created_at' => '2023-04-29 15:55:56',
                'id' => 3,
                'name' => 'Lawyer Consultation Personal Access Client',
                'password_client' => 0,
                'personal_access_client' => 1,
                'provider' => NULL,
                'redirect' => 'http://localhost',
                'revoked' => 0,
                'secret' => 'PzbRsLXDA4PWiA5Qd5pw2kNorrunJJjUntw1so8E',
                'updated_at' => '2023-04-29 15:55:56',
                'user_id' => NULL,
            ),
            3 => 
            array (
                'created_at' => '2023-04-29 15:55:56',
                'id' => 4,
                'name' => 'Lawyer Consultation Password Grant Client',
                'password_client' => 1,
                'personal_access_client' => 0,
                'provider' => 'users',
                'redirect' => 'http://localhost',
                'revoked' => 0,
                'secret' => 'VJUvJ5W6Ib3Wdgvotko66hukb75h10SsFD8IGQEJ',
                'updated_at' => '2023-04-29 15:55:56',
                'user_id' => NULL,
            ),
        ));
        
        
    }
}