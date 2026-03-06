<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LawyerPaymentsHistoryTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('lawyer_payments_history')->delete();
        
        
        
    }
}