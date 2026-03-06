<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PricingPlansTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('pricing_plans')->delete();
        
        \DB::table('pricing_plans')->insert(array (
            0 => 
            array (
                'color' => '#bc9494',
                'created_at' => '2023-01-06 20:11:07',
                'deleted_at' => NULL,
                'description' => '<p>Bronze some information</p>',
                'id' => 1,
                'image' => '/images/subscriptions/1673035867Screenshot from 2022-12-11 00-50-51.png',
                'is_active' => 0,
                'is_default' => 1,
                'is_paid' => 0,
                'name' => 'Micky Mouse',
                'price' => 0.0,
                'slug' => 'micky-mouse-1',
                'sort_order' => NULL,
                'stripe_plan' => NULL,
                'tagline' => 'Test Tagline For Micky Mouse',
                'type' => 'lawyer',
                'updated_at' => '2023-10-04 16:49:15',
            ),
            1 => 
            array (
                'color' => '#000000',
                'created_at' => '2023-02-13 15:40:24',
                'deleted_at' => NULL,
                'description' => '<p>Basic</p>',
                'id' => 2,
                'image' => NULL,
                'is_active' => 1,
                'is_default' => 1,
                'is_paid' => 0,
                'name' => 'Basic',
                'price' => 0.0,
                'slug' => 'basic-2',
                'sort_order' => NULL,
                'stripe_plan' => NULL,
                'tagline' => NULL,
                'type' => 'law_firm',
                'updated_at' => '2023-03-15 22:23:04',
            ),
            2 => 
            array (
                'color' => NULL,
                'created_at' => '2023-02-13 16:42:20',
                'deleted_at' => NULL,
                'description' => '<p>silver</p>',
                'id' => 49,
                'image' => NULL,
                'is_active' => 1,
                'is_default' => 0,
                'is_paid' => 0,
                'name' => 'Silver',
                'price' => 0.0,
                'slug' => 'silver',
                'sort_order' => NULL,
                'stripe_plan' => NULL,
                'tagline' => NULL,
                'type' => 'lawyer',
                'updated_at' => '2023-02-14 15:32:50',
            ),
            3 => 
            array (
                'color' => NULL,
                'created_at' => '2023-02-17 17:19:17',
                'deleted_at' => NULL,
                'description' => '<p>gold</p>',
                'id' => 50,
                'image' => '/images/subscriptions/63efba60307d7.png',
                'is_active' => 1,
                'is_default' => 0,
                'is_paid' => 0,
                'name' => 'Gold',
                'price' => 0.0,
                'slug' => 'gold',
                'sort_order' => NULL,
                'stripe_plan' => NULL,
                'tagline' => NULL,
                'type' => 'lawyer',
                'updated_at' => '2023-02-17 17:33:20',
            ),
            4 => 
            array (
                'color' => NULL,
                'created_at' => '2023-02-17 17:19:17',
                'deleted_at' => NULL,
                'description' => '<p>platinum</p>',
                'id' => 51,
                'image' => '/images/subscriptions/63efba60307d7.png',
                'is_active' => 1,
                'is_default' => 0,
                'is_paid' => 0,
                'name' => 'Platinum',
                'price' => 0.0,
                'slug' => 'platinum',
                'sort_order' => NULL,
                'stripe_plan' => NULL,
                'tagline' => NULL,
                'type' => 'lawyer',
                'updated_at' => '2023-02-17 17:33:20',
            ),
            5 => 
            array (
                'color' => NULL,
                'created_at' => '2023-03-13 21:15:11',
                'deleted_at' => '2023-11-17 19:37:21',
                'description' => 'ok',
                'id' => 52,
                'image' => NULL,
                'is_active' => 1,
                'is_default' => 0,
                'is_paid' => 1,
                'name' => 'silver',
                'price' => 50.0,
                'slug' => 'silver-52',
                'sort_order' => NULL,
                'stripe_plan' => 'price_1MkY0VHTAHWwyrB6Vl3f8ZIT',
                'tagline' => NULL,
                'type' => NULL,
                'updated_at' => '2023-11-17 19:37:21',
            ),
            6 => 
            array (
                'color' => '#000000',
                'created_at' => '2023-03-13 21:15:11',
                'deleted_at' => NULL,
                'description' => '<p>Ok</p>',
                'id' => 53,
                'image' => NULL,
                'is_active' => 1,
                'is_default' => 0,
                'is_paid' => 1,
                'name' => 'gold',
                'price' => 50.0,
                'slug' => 'gold-53',
                'sort_order' => NULL,
                'stripe_plan' => 'price_1MkPGfHTAHWwyrB6thyCbJXk',
                'tagline' => NULL,
                'type' => 'lawyer',
                'updated_at' => '2023-11-14 12:26:58',
            ),
            7 => 
            array (
                'color' => NULL,
                'created_at' => '2023-09-12 19:53:23',
                'deleted_at' => NULL,
                'description' => 'Platinum Membership',
                'id' => 54,
                'image' => NULL,
                'is_active' => 1,
                'is_default' => 0,
                'is_paid' => 1,
                'name' => 'Platinum',
                'price' => 99.99,
                'slug' => 'platinum-54',
                'sort_order' => NULL,
                'stripe_plan' => 'price_1MtCVpHTAHWwyrB6y9w1pYFi',
                'tagline' => NULL,
                'type' => NULL,
                'updated_at' => '2023-09-12 19:53:24',
            ),
            8 => 
            array (
                'color' => '#000000',
                'created_at' => '2023-11-14 15:32:37',
                'deleted_at' => '2023-11-14 15:35:35',
                'description' => '<p>ok</p>',
                'id' => 55,
                'image' => NULL,
                'is_active' => 1,
                'is_default' => 0,
                'is_paid' => 0,
                'name' => 'Platinium',
                'price' => 100.0,
                'slug' => 'platinium-55',
                'sort_order' => NULL,
                'stripe_plan' => NULL,
                'tagline' => NULL,
                'type' => 'lawyer',
                'updated_at' => '2023-11-14 15:35:35',
            ),
            9 => 
            array (
                'color' => '#000000',
                'created_at' => '2023-11-14 15:48:01',
                'deleted_at' => '2023-11-14 15:49:12',
                'description' => '<p>ok</p>',
                'id' => 56,
                'image' => NULL,
                'is_active' => 1,
                'is_default' => 0,
                'is_paid' => 0,
                'name' => 'Crown',
                'price' => 100.0,
                'slug' => 'crown-56',
                'sort_order' => NULL,
                'stripe_plan' => NULL,
                'tagline' => NULL,
                'type' => 'lawyer',
                'updated_at' => '2023-11-14 15:49:12',
            ),
        ));
        
        
    }
}