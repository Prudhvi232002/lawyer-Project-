<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class InAppNotificationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('in_app_notifications')->delete();
        
        \DB::table('in_app_notifications')->insert(array (
            0 => 
            array (
                'created_at' => '2024-05-02 11:33:56',
                'deleted_at' => NULL,
                'description' => 'approve_or_reject_lawyer',
                'id' => 1,
                'is_seen' => 1,
                'name' => 'approve_or_reject_lawyer',
                'redirect_url' => NULL,
                'updated_at' => '2024-05-07 11:13:19',
                'user_id' => 44,
            ),
            1 => 
            array (
                'created_at' => '2024-05-02 12:05:47',
                'deleted_at' => NULL,
                'description' => 'You have a new notification',
                'id' => 2,
                'is_seen' => 0,
                'name' => 'Lawyer Approved Successfully',
                'redirect_url' => 'super_admin/lawyers',
                'updated_at' => '2024-05-02 12:05:47',
                'user_id' => 1,
            ),
            2 => 
            array (
                'created_at' => '2024-05-02 12:06:03',
                'deleted_at' => NULL,
                'description' => 'You have a new notification',
                'id' => 3,
                'is_seen' => 0,
                'name' => 'Lawyer Approved Successfully',
                'redirect_url' => 'super_admin/lawyers',
                'updated_at' => '2024-05-02 12:06:03',
                'user_id' => 1,
            ),
            3 => 
            array (
                'created_at' => '2024-05-02 13:00:37',
                'deleted_at' => NULL,
                'description' => 'You have a new notification',
                'id' => 4,
                'is_seen' => 0,
                'name' => 'Appointment Booked Successfully',
                'redirect_url' => '/appointment_log/detail/256',
                'updated_at' => '2024-05-02 13:00:37',
                'user_id' => 47,
            ),
            4 => 
            array (
                'created_at' => '2024-05-02 13:00:37',
                'deleted_at' => NULL,
                'description' => 'You have a new notification',
                'id' => 5,
                'is_seen' => 0,
                'name' => 'Appointment Booked Successfully',
                'redirect_url' => '/appointment_log/detail/256',
                'updated_at' => '2024-05-02 13:00:37',
                'user_id' => 17,
            ),
            5 => 
            array (
                'created_at' => '2024-05-06 06:16:06',
                'deleted_at' => NULL,
                'description' => 'You have a new notification',
                'id' => 6,
                'is_seen' => 0,
                'name' => 'Lawyer Approved Successfully',
                'redirect_url' => 'super_admin/lawyers',
                'updated_at' => '2024-05-06 06:16:06',
                'user_id' => 47,
            ),
            6 => 
            array (
                'created_at' => '2024-05-06 06:21:50',
                'deleted_at' => NULL,
                'description' => 'You have a new notification',
                'id' => 7,
                'is_seen' => 0,
                'name' => 'Appointment Booked Successfully',
                'redirect_url' => '/appointment_log/detail/261',
                'updated_at' => '2024-05-06 06:21:50',
                'user_id' => 17,
            ),
            7 => 
            array (
                'created_at' => '2024-05-06 06:21:50',
                'deleted_at' => NULL,
                'description' => 'You have a new notification',
                'id' => 8,
                'is_seen' => 0,
                'name' => 'Appointment Booked Successfully',
                'redirect_url' => '/appointment_log/detail/261',
                'updated_at' => '2024-05-06 06:21:50',
                'user_id' => 17,
            ),
            8 => 
            array (
                'created_at' => '2024-05-06 06:28:15',
                'deleted_at' => NULL,
                'description' => 'You have a new notification',
                'id' => 9,
                'is_seen' => 0,
                'name' => 'Lawyer Approved Successfully',
                'redirect_url' => 'super_admin/lawyers',
                'updated_at' => '2024-05-06 06:28:15',
                'user_id' => 58,
            ),
            9 => 
            array (
                'created_at' => '2024-05-17 10:33:07',
                'deleted_at' => NULL,
                'description' => 'You have a new notification',
                'id' => 10,
                'is_seen' => 0,
                'name' => 'Lawyer Approved Successfully',
                'redirect_url' => 'super_admin/lawyers',
                'updated_at' => '2024-05-17 10:33:07',
                'user_id' => 48,
            ),
        ));
        
        
    }
}