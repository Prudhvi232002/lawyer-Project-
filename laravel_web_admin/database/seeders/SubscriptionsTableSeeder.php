<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SubscriptionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('subscriptions')->delete();
        
        \DB::table('subscriptions')->insert(array (
            0 => 
            array (
                'created_at' => '2023-11-14 14:56:57',
                'ends_at' => NULL,
                'id' => 1,
                'law_firm_id' => NULL,
                'lawyer_id' => 36,
                'name' => 'gold-53',
                'quantity' => 1,
                'stripe_id' => 'sub_1OCJMbHTAHWwyrB6XJufH18Q',
                'stripe_price' => 'price_1MkPGfHTAHWwyrB6thyCbJXk',
                'stripe_status' => 'active',
                'trial_ends_at' => NULL,
                'updated_at' => '2023-11-14 14:56:59',
            ),
            1 => 
            array (
                'created_at' => '2023-11-14 15:33:53',
                'ends_at' => NULL,
                'id' => 2,
                'law_firm_id' => NULL,
                'lawyer_id' => 36,
                'name' => 'gold-53',
                'quantity' => 1,
                'stripe_id' => 'sub_1OCJwKHTAHWwyrB6GuBRoFPJ',
                'stripe_price' => 'price_1MkPGfHTAHWwyrB6thyCbJXk',
                'stripe_status' => 'active',
                'trial_ends_at' => NULL,
                'updated_at' => '2023-11-14 15:33:55',
            ),
            2 => 
            array (
                'created_at' => '2023-11-23 16:11:47',
                'ends_at' => NULL,
                'id' => 3,
                'law_firm_id' => NULL,
                'lawyer_id' => 42,
                'name' => 'gold-53',
                'quantity' => 1,
                'stripe_id' => 'sub_1OFaowHTAHWwyrB66HZxZsvu',
                'stripe_price' => 'price_1MkPGfHTAHWwyrB6thyCbJXk',
                'stripe_status' => 'active',
                'trial_ends_at' => NULL,
                'updated_at' => '2023-11-23 16:11:49',
            ),
            3 => 
            array (
                'created_at' => '2023-11-23 19:27:33',
                'ends_at' => NULL,
                'id' => 4,
                'law_firm_id' => NULL,
                'lawyer_id' => 46,
                'name' => 'gold-53',
                'quantity' => 1,
                'stripe_id' => 'sub_1OFdsPHTAHWwyrB6XtpJiDjI',
                'stripe_price' => 'price_1MkPGfHTAHWwyrB6thyCbJXk',
                'stripe_status' => 'active',
                'trial_ends_at' => NULL,
                'updated_at' => '2023-11-23 19:27:35',
            ),
            4 => 
            array (
                'created_at' => '2023-11-24 02:50:13',
                'ends_at' => NULL,
                'id' => 5,
                'law_firm_id' => NULL,
                'lawyer_id' => 47,
                'name' => 'gold-53',
                'quantity' => 1,
                'stripe_id' => 'sub_1OFkmmHTAHWwyrB6nRSwefde',
                'stripe_price' => 'price_1MkPGfHTAHWwyrB6thyCbJXk',
                'stripe_status' => 'active',
                'trial_ends_at' => NULL,
                'updated_at' => '2023-11-24 02:50:15',
            ),
            5 => 
            array (
                'created_at' => '2024-02-24 18:14:59',
                'ends_at' => NULL,
                'id' => 6,
                'law_firm_id' => NULL,
                'lawyer_id' => 46,
                'name' => 'gold-53',
                'quantity' => 1,
                'stripe_id' => 'sub_1OnL4AHTAHWwyrB6oavQYVpK',
                'stripe_price' => 'price_1MkPGfHTAHWwyrB6thyCbJXk',
                'stripe_status' => 'active',
                'trial_ends_at' => NULL,
                'updated_at' => '2024-02-24 18:15:00',
            ),
            6 => 
            array (
                'created_at' => '2024-04-30 13:04:30',
                'ends_at' => NULL,
                'id' => 7,
                'law_firm_id' => NULL,
                'lawyer_id' => 46,
                'name' => 'gold-53',
                'quantity' => 1,
                'stripe_id' => 'sub_1PBBftHTAHWwyrB6fyDXPYCZ',
                'stripe_price' => 'price_1MkPGfHTAHWwyrB6thyCbJXk',
                'stripe_status' => 'active',
                'trial_ends_at' => NULL,
                'updated_at' => '2024-04-30 13:04:32',
            ),
        ));
        
        
    }
}