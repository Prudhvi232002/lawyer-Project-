<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SocialAccountsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('social_accounts')->delete();
        
        \DB::table('social_accounts')->insert(array (
            0 => 
            array (
                'created_at' => '2023-01-10 18:52:12',
                'id' => 2,
                'provider_id' => '3236273933184827',
                'provider_name' => 'facebook',
                'updated_at' => '2023-01-10 18:52:12',
                'user_id' => 249,
            ),
            1 => 
            array (
                'created_at' => '2023-01-10 20:46:00',
                'id' => 3,
                'provider_id' => '103935128277036738360',
                'provider_name' => 'google',
                'updated_at' => '2023-01-10 20:46:00',
                'user_id' => 250,
            ),
            2 => 
            array (
                'created_at' => '2023-01-21 16:52:50',
                'id' => 4,
                'provider_id' => '105431641228825580963',
                'provider_name' => 'google',
                'updated_at' => '2023-01-21 16:52:50',
                'user_id' => 267,
            ),
            3 => 
            array (
                'created_at' => '2023-03-01 03:12:13',
                'id' => 5,
                'provider_id' => '105723566399447041160',
                'provider_name' => 'google',
                'updated_at' => '2023-03-01 03:12:13',
                'user_id' => 274,
            ),
            4 => 
            array (
                'created_at' => '2023-03-02 19:00:55',
                'id' => 6,
                'provider_id' => '108733358469025002263',
                'provider_name' => 'google',
                'updated_at' => '2023-03-02 19:00:55',
                'user_id' => 294,
            ),
        ));
        
        
    }
}