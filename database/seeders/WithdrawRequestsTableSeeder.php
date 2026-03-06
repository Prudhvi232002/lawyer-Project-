<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class WithdrawRequestsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('withdraw_requests')->delete();
        
        \DB::table('withdraw_requests')->insert(array (
            0 => 
            array (
                'account_holder' => 'Isabella',
                'account_number' => '4025123456784500',
                'additional_note' => 'Thanks For Pamyent',
                'amount' => 500,
                'bank' => 'ALfalah',
                'created_at' => '2024-01-15 13:40:09',
                'id' => 1,
                'rejected_reason' => NULL,
                'status' => 'approved',
                'updated_at' => '2024-01-15 13:43:03',
                'user_id' => 17,
            ),
            1 => 
            array (
                'account_holder' => 'Isabella',
                'account_number' => '4512451245124512',
                'additional_note' => 'Thanks',
                'amount' => 20,
                'bank' => 'AFL',
                'created_at' => '2024-01-15 13:49:23',
                'id' => 2,
                'rejected_reason' => NULL,
                'status' => 'pending',
                'updated_at' => '2024-01-15 13:49:23',
                'user_id' => 17,
            ),
            2 => 
            array (
                'account_holder' => 'Isabella',
                'account_number' => '4512451245124512',
                'additional_note' => 'Thanks',
                'amount' => 20,
                'bank' => 'AFL',
                'created_at' => '2024-01-15 13:50:11',
                'id' => 3,
                'rejected_reason' => NULL,
                'status' => 'pending',
                'updated_at' => '2024-01-15 13:50:11',
                'user_id' => 17,
            ),
            3 => 
            array (
                'account_holder' => 'Isabella',
                'account_number' => '4512451265326532',
                'additional_note' => 'Withdraw',
                'amount' => 50,
                'bank' => 'HBL',
                'created_at' => '2024-01-15 13:51:53',
                'id' => 4,
                'rejected_reason' => NULL,
                'status' => 'pending',
                'updated_at' => '2024-01-15 13:51:53',
                'user_id' => 17,
            ),
            4 => 
            array (
                'account_holder' => 'Mono',
                'account_number' => '4215421562536253',
                'additional_note' => 'Testing',
                'amount' => 50,
                'bank' => 'HBL',
                'created_at' => '2024-01-16 13:39:54',
                'id' => 5,
                'rejected_reason' => NULL,
                'status' => 'pending',
                'updated_at' => '2024-01-16 13:39:54',
                'user_id' => 17,
            ),
            5 => 
            array (
                'account_holder' => 'Mono',
                'account_number' => '123456789987654321',
                'additional_note' => 'from mobile',
                'amount' => 20,
                'bank' => 'fgl',
                'created_at' => '2024-01-16 13:41:25',
                'id' => 6,
                'rejected_reason' => NULL,
                'status' => 'pending',
                'updated_at' => '2024-01-16 13:41:25',
                'user_id' => 17,
            ),
            6 => 
            array (
                'account_holder' => 'gnnn',
                'account_number' => '56hh',
                'additional_note' => 'vbnff',
                'amount' => 45,
                'bank' => 'hhh',
                'created_at' => '2024-01-16 14:58:16',
                'id' => 7,
                'rejected_reason' => NULL,
                'status' => 'pending',
                'updated_at' => '2024-01-16 14:58:16',
                'user_id' => 17,
            ),
        ));
        
        
    }
}