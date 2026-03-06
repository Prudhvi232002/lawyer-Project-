<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class NotificationSettingsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('notification_settings')->delete();
        
        \DB::table('notification_settings')->insert(array (
            0 => 
            array (
                'created_at' => '2024-04-29 14:03:30',
                'deleted_at' => NULL,
                'display_name' => 'New SignUp Customer',
                'id' => 1,
                'is_active' => 1,
                'is_email_send' => 0,
                'is_in_app_notification_send' => 0,
                'is_push_notification_send' => 0,
                'notification_category' => 'Register',
                'setting_name' => 'new-signup-customer',
                'updated_at' => '2024-05-02 10:59:39',
            ),
            1 => 
            array (
                'created_at' => '2024-04-29 14:03:30',
                'deleted_at' => NULL,
                'display_name' => 'New SignUp Law',
                'id' => 2,
                'is_active' => 1,
                'is_email_send' => 0,
                'is_in_app_notification_send' => 0,
                'is_push_notification_send' => 0,
                'notification_category' => 'Register',
                'setting_name' => 'new-signup-law',
                'updated_at' => '2024-05-02 10:59:39',
            ),
            2 => 
            array (
                'created_at' => '2024-04-29 14:03:30',
                'deleted_at' => NULL,
                'display_name' => 'New SignUp LawFirm',
                'id' => 3,
                'is_active' => 1,
                'is_email_send' => 0,
                'is_in_app_notification_send' => 0,
                'is_push_notification_send' => 0,
                'notification_category' => 'Register',
                'setting_name' => 'new-signup-law-firm',
                'updated_at' => '2024-05-02 10:59:39',
            ),
            3 => 
            array (
                'created_at' => '2024-04-29 14:03:30',
                'deleted_at' => NULL,
                'display_name' => 'Change Password',
                'id' => 4,
                'is_active' => 1,
                'is_email_send' => 0,
                'is_in_app_notification_send' => 0,
                'is_push_notification_send' => 0,
                'notification_category' => 'Register',
                'setting_name' => 'change_password',
                'updated_at' => '2024-05-02 10:59:39',
            ),
            4 => 
            array (
                'created_at' => '2024-04-29 14:03:30',
                'deleted_at' => NULL,
                'display_name' => 'Reset Password',
                'id' => 5,
                'is_active' => 1,
                'is_email_send' => 0,
                'is_in_app_notification_send' => 0,
                'is_push_notification_send' => 0,
                'notification_category' => 'Register',
                'setting_name' => 'reset_password',
                'updated_at' => '2024-05-02 10:59:39',
            ),
            5 => 
            array (
                'created_at' => '2024-04-29 14:03:30',
                'deleted_at' => NULL,
                'display_name' => 'Approve/Reject Lawyer',
                'id' => 6,
                'is_active' => 1,
                'is_email_send' => 1,
                'is_in_app_notification_send' => 1,
                'is_push_notification_send' => 0,
                'notification_category' => 'Register',
                'setting_name' => 'approve_or_reject_lawyer',
                'updated_at' => '2024-05-02 16:30:30',
            ),
            6 => 
            array (
                'created_at' => '2024-04-29 14:03:30',
                'deleted_at' => NULL,
                'display_name' => 'Approve/Reject LawFirm',
                'id' => 7,
                'is_active' => 1,
                'is_email_send' => 0,
                'is_in_app_notification_send' => 0,
                'is_push_notification_send' => 0,
                'notification_category' => 'Register',
                'setting_name' => 'approve_or_reject_law_firm',
                'updated_at' => '2024-05-02 16:30:16',
            ),
            7 => 
            array (
                'created_at' => '2024-04-29 14:03:30',
                'deleted_at' => NULL,
                'display_name' => 'New Appointment Registration',
                'id' => 8,
                'is_active' => 1,
                'is_email_send' => 1,
                'is_in_app_notification_send' => 1,
                'is_push_notification_send' => 0,
                'notification_category' => 'Appointment',
                'setting_name' => 'new_appointment_registration',
                'updated_at' => '2024-05-02 18:00:13',
            ),
            8 => 
            array (
                'created_at' => '2024-04-29 14:03:30',
                'deleted_at' => NULL,
                'display_name' => 'Change Appointment Status',
                'id' => 9,
                'is_active' => 1,
                'is_email_send' => 1,
                'is_in_app_notification_send' => 1,
                'is_push_notification_send' => 0,
                'notification_category' => 'Appointment',
                'setting_name' => 'change_appointment_status',
                'updated_at' => '2024-05-02 10:59:39',
            ),
            9 => 
            array (
                'created_at' => '2024-04-29 14:03:30',
                'deleted_at' => NULL,
                'display_name' => 'Before One Hour Appointment Notification',
                'id' => 10,
                'is_active' => 1,
                'is_email_send' => 1,
                'is_in_app_notification_send' => 0,
                'is_push_notification_send' => 0,
                'notification_category' => 'Appointment',
                'setting_name' => 'before_hour_appointment_notification',
                'updated_at' => '2024-05-02 10:59:39',
            ),
            10 => 
            array (
                'created_at' => '2024-04-29 19:03:30',
                'deleted_at' => NULL,
                'display_name' => 'Quick Service Registered',
                'id' => 11,
                'is_active' => 1,
                'is_email_send' => 0,
                'is_in_app_notification_send' => 0,
                'is_push_notification_send' => 0,
                'notification_category' => 'Quick Services',
                'setting_name' => 'book_quick_service',
                'updated_at' => '2024-05-02 15:59:39',
            ),
        ));
        
        
    }
}