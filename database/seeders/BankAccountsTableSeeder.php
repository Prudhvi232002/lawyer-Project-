<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BankAccountsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('bank_accounts')->delete();
        
        \DB::table('bank_accounts')->insert(array (
            0 => 
            array (
                'account_holder_name' => 'Joe Doe',
                'account_number' => '0321654987123654789',
                'bic_swift' => 'bicswift15451435',
                'created_at' => NULL,
                'deleted_at' => NULL,
                'description' => 'Habib Bank Limited',
                'iban_number' => 'abcd1235458798751dsad',
                'id' => 1,
                'is_active' => 1,
                'name' => 'Habib Bank Limited',
                'sort_code' => '1',
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'account_holder_name' => 'Rhea Baxter updated',
                'account_number' => '12132154548474564',
                'bic_swift' => 'adsdasd',
                'created_at' => '2024-05-10 13:44:02',
                'deleted_at' => '2024-05-11 05:03:54',
                'description' => NULL,
                'iban_number' => 'ABC123654789',
                'id' => 2,
                'is_active' => 1,
                'name' => 'Al Habib',
                'sort_code' => NULL,
                'updated_at' => '2024-05-11 05:03:54',
            ),
            2 => 
            array (
                'account_holder_name' => 'Mr.Haseeb',
                'account_number' => '78965412332145',
                'bic_swift' => 'dadasd',
                'created_at' => '2024-05-11 05:06:30',
                'deleted_at' => NULL,
                'description' => '<p>asdaqdasdasdasd</p>',
                'iban_number' => '594651654976516njgdasd',
                'id' => 3,
                'is_active' => 1,
                'name' => 'Meezan Bank',
                'sort_code' => NULL,
                'updated_at' => '2024-05-11 05:06:30',
            ),
        ));
        
        
    }
}