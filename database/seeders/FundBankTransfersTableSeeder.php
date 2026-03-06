<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class FundBankTransfersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('fund_bank_transfers')->delete();
        
        \DB::table('fund_bank_transfers')->insert(array (
            0 => 
            array (
                'attachment' => NULL,
                'bank_account_id' => 1,
                'created_at' => '2024-05-11 09:56:59',
                'date' => NULL,
                'deleted_at' => NULL,
                'fund_id' => NULL,
                'id' => 1,
                'updated_at' => '2024-05-11 09:56:59',
            ),
            1 => 
            array (
                'attachment' => NULL,
                'bank_account_id' => 1,
                'created_at' => '2024-05-11 10:05:20',
                'date' => NULL,
                'deleted_at' => NULL,
                'fund_id' => 237,
                'id' => 2,
                'updated_at' => '2024-05-11 10:05:20',
            ),
            2 => 
            array (
                'attachment' => NULL,
                'bank_account_id' => 3,
                'created_at' => '2024-05-11 10:06:09',
                'date' => NULL,
                'deleted_at' => NULL,
                'fund_id' => 237,
                'id' => 3,
                'updated_at' => '2024-05-11 10:06:09',
            ),
            3 => 
            array (
                'attachment' => '/private/var/folders/ck/2t30ht_s2374bknm0d14v3vr0000gn/T/phpfTqexs',
                'bank_account_id' => 3,
                'created_at' => '2024-05-11 10:09:24',
                'date' => NULL,
                'deleted_at' => NULL,
                'fund_id' => 237,
                'id' => 4,
                'updated_at' => '2024-05-11 10:09:24',
            ),
            4 => 
            array (
                'attachment' => '/private/var/folders/ck/2t30ht_s2374bknm0d14v3vr0000gn/T/phpUjhqfa',
                'bank_account_id' => 3,
                'created_at' => '2024-05-11 10:10:38',
                'date' => '2024-05-11 10:10:38',
                'deleted_at' => NULL,
                'fund_id' => 237,
                'id' => 5,
                'updated_at' => '2024-05-11 10:10:38',
            ),
        ));
        
        
    }
}