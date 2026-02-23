<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ContactsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('contacts')->delete();
        
        \DB::table('contacts')->insert(array (
            0 => 
            array (
                'created_at' => '2023-09-19 11:17:43',
                'deleted_at' => NULL,
                'email' => 'Contact@gg.com',
                'id' => 1,
                'message' => 'ljksdfjksdgdh kjsdfh skjdfhs skjdfh sdkh f',
                'name' => 'Contact',
                'phone' => '31231231',
                'updated_at' => '2023-09-19 11:17:43',
            ),
            1 => 
            array (
                'created_at' => '2023-09-19 11:19:29',
                'deleted_at' => NULL,
                'email' => 'Name@ss.com',
                'id' => 2,
                'message' => 'sadfsdfsdfdsf',
                'name' => 'Name',
                'phone' => '234234234234',
                'updated_at' => '2023-09-19 11:19:29',
            ),
            2 => 
            array (
                'created_at' => '2023-09-19 11:20:09',
                'deleted_at' => NULL,
                'email' => 'In@gg.com',
                'id' => 3,
                'message' => 'sdnbfsfbgsfsj kdjhjkdfh kdfhg',
                'name' => 'In',
                'phone' => '23423423',
                'updated_at' => '2023-09-19 11:20:09',
            ),
            3 => 
            array (
                'created_at' => '2023-11-02 15:06:33',
                'deleted_at' => NULL,
                'email' => 'fazfaizan22@gmail.com',
                'id' => 4,
                'message' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.',
                'name' => 'Faizan',
                'phone' => '03143923536',
                'updated_at' => '2023-11-02 15:06:33',
            ),
            4 => 
            array (
                'created_at' => '2023-11-02 15:07:38',
                'deleted_at' => NULL,
                'email' => 'fazfaizan22@gmail.com',
                'id' => 5,
                'message' => 'eQWEQWEQWEQWEQWEQWEQWE',
                'name' => 'Faizan',
                'phone' => '232232',
                'updated_at' => '2023-11-02 15:07:38',
            ),
            5 => 
            array (
                'created_at' => '2023-11-02 15:47:11',
                'deleted_at' => NULL,
                'email' => 'fazfaizan22@gmail.com',
                'id' => 6,
                'message' => 'eQWEQWEQWEQWEQWEQWEQWE',
                'name' => 'Faizan',
                'phone' => '232232',
                'updated_at' => '2023-11-02 15:47:11',
            ),
            6 => 
            array (
                'created_at' => '2023-11-02 17:05:37',
                'deleted_at' => NULL,
                'email' => 'jack@gmail.com',
                'id' => 7,
            'message' => '"The Total Lawyers section currently lists 5 active lawyers within the system, as indicated by the accompanying dashboard image (dashboard-image-1.png). Moving on to Total Users, there are presently 8 registered users on the platform, as depicted by the associated image (total-users.png). As for Total Subscriptions, there are currently no active subscriptions at this time.

In addition, the system boasts a total of 92 upcoming events, all ready to be showcased on the dashboard for easy access and reference. The Total Appointments stand at 53, showcasing the busy schedule of consultations and meetings. Furthermore, the platform serves a total of 8 customers who rely on the services provided."',
                'name' => 'jack deen',
                'phone' => '121211 1121',
                'updated_at' => '2023-11-02 17:05:37',
            ),
            7 => 
            array (
                'created_at' => '2023-11-02 18:38:35',
                'deleted_at' => NULL,
                'email' => 'faizan@gmail.com',
                'id' => 8,
                'message' => 'asdaddsadsdadad',
                'name' => 'sdas',
                'phone' => '121212',
                'updated_at' => '2023-11-02 18:38:35',
            ),
            8 => 
            array (
                'created_at' => '2024-03-31 11:08:57',
                'deleted_at' => NULL,
                'email' => 'aaa@jhhh.nnn',
                'id' => 9,
                'message' => 'cdf',
                'name' => 'nnnaa',
                'phone' => '1234554321',
                'updated_at' => '2024-03-31 11:08:57',
            ),
            9 => 
            array (
                'created_at' => '2024-03-31 11:09:00',
                'deleted_at' => NULL,
                'email' => 'aaa@jhhh.nnn',
                'id' => 10,
                'message' => 'cdf',
                'name' => 'nnnaa',
                'phone' => '1234554321',
                'updated_at' => '2024-03-31 11:09:00',
            ),
            10 => 
            array (
                'created_at' => '2024-03-31 11:09:11',
                'deleted_at' => NULL,
                'email' => 'aaa@jhhh.nnn',
                'id' => 11,
                'message' => 'സിഡ്‌ഫ്‌ഠാസ്ഡ്സ്സസ്സ് edsdee',
                'name' => 'nnnaa',
                'phone' => '1234554321',
                'updated_at' => '2024-03-31 11:09:11',
            ),
            11 => 
            array (
                'created_at' => '2024-03-31 11:09:12',
                'deleted_at' => NULL,
                'email' => 'aaa@jhhh.nnn',
                'id' => 12,
                'message' => 'സിഡ്‌ഫ്‌ഠാസ്ഡ്സ്സസ്സ് edsdee',
                'name' => 'nnnaa',
                'phone' => '1234554321',
                'updated_at' => '2024-03-31 11:09:12',
            ),
        ));
        
        
    }
}