<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SubscriptionItemsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('subscription_items')->delete();
        
        \DB::table('subscription_items')->insert(array (
            0 => 
            array (
                'created_at' => '2023-11-14 14:56:57',
                'id' => 1,
                'quantity' => 1,
                'stripe_id' => 'si_P0K0E065xYNh52',
                'stripe_price' => 'price_1MkPGfHTAHWwyrB6thyCbJXk',
                'stripe_product' => 'prod_NVQ6mrb4RxpwQx',
                'subscription_id' => 1,
                'updated_at' => '2023-11-14 14:56:57',
            ),
            1 => 
            array (
                'created_at' => '2023-11-14 15:33:53',
                'id' => 2,
                'quantity' => 1,
                'stripe_id' => 'si_P0KbZeKmkhio7m',
                'stripe_price' => 'price_1MkPGfHTAHWwyrB6thyCbJXk',
                'stripe_product' => 'prod_NVQ6mrb4RxpwQx',
                'subscription_id' => 2,
                'updated_at' => '2023-11-14 15:33:53',
            ),
            2 => 
            array (
                'created_at' => '2023-11-23 16:11:47',
                'id' => 3,
                'quantity' => 1,
                'stripe_id' => 'si_P3iFLQpYUxw1nW',
                'stripe_price' => 'price_1MkPGfHTAHWwyrB6thyCbJXk',
                'stripe_product' => 'prod_NVQ6mrb4RxpwQx',
                'subscription_id' => 3,
                'updated_at' => '2023-11-23 16:11:47',
            ),
            3 => 
            array (
                'created_at' => '2023-11-23 19:27:33',
                'id' => 4,
                'quantity' => 1,
                'stripe_id' => 'si_P3lPrRwzY3pws4',
                'stripe_price' => 'price_1MkPGfHTAHWwyrB6thyCbJXk',
                'stripe_product' => 'prod_NVQ6mrb4RxpwQx',
                'subscription_id' => 4,
                'updated_at' => '2023-11-23 19:27:33',
            ),
            4 => 
            array (
                'created_at' => '2023-11-24 02:50:13',
                'id' => 5,
                'quantity' => 1,
                'stripe_id' => 'si_P3sX3xQtd168uw',
                'stripe_price' => 'price_1MkPGfHTAHWwyrB6thyCbJXk',
                'stripe_product' => 'prod_NVQ6mrb4RxpwQx',
                'subscription_id' => 5,
                'updated_at' => '2023-11-24 02:50:13',
            ),
            5 => 
            array (
                'created_at' => '2024-02-24 18:14:59',
                'id' => 6,
                'quantity' => 1,
                'stripe_id' => 'si_PcaEVan9UhpfeZ',
                'stripe_price' => 'price_1MkPGfHTAHWwyrB6thyCbJXk',
                'stripe_product' => 'prod_NVQ6mrb4RxpwQx',
                'subscription_id' => 6,
                'updated_at' => '2024-02-24 18:14:59',
            ),
            6 => 
            array (
                'created_at' => '2024-04-30 13:04:30',
                'id' => 7,
                'quantity' => 1,
                'stripe_id' => 'si_Q1E85NSlAClSLT',
                'stripe_price' => 'price_1MkPGfHTAHWwyrB6thyCbJXk',
                'stripe_product' => 'prod_NVQ6mrb4RxpwQx',
                'subscription_id' => 7,
                'updated_at' => '2024-04-30 13:04:30',
            ),
        ));
        
        
    }
}