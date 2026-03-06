<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ServiceCategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('service_categories')->delete();
        
        \DB::table('service_categories')->insert(array (
            0 => 
            array (
                'created_at' => '2023-10-04 14:09:03',
                'deleted_at' => NULL,
                'description' => '{"en":"<p>Criminal Law, often referred to simply as criminal law, encompasses the legal principles governing the activities of administrative agencies of government. It involves the procedures, rules, and regulations that these agencies create and enforce to ensure compliance with laws enacted by<\\/p>","hi":"<ul>\\r\\n\\t<li>\\u0915\\u0941\\u0916\\u094d\\u092f\\u093e\\u0924\\u093f \\u0915\\u093e\\u0928\\u0942\\u0928 \\u0915\\u093e \\u092a\\u0930\\u093f\\u091a\\u092f<\\/li>\\r\\n\\t<li>\\u0915\\u0941\\u0916\\u094d\\u092f\\u093e\\u0924\\u093f \\u092a\\u094d\\u0930\\u0915\\u094d\\u0930\\u093f\\u092f\\u093e<\\/li>\\r\\n\\t<li>\\u0938\\u092b\\u0947\\u0926 \\u0915\\u0949\\u0932\\u0930 \\u0905\\u092a\\u0930\\u093e\\u0927<\\/li>\\r\\n\\t<li>\\u0938\\u093e\\u0907\\u092c\\u0930 \\u0905\\u092a\\u0930\\u093e\\u0927 \\u0914\\u0930 \\u0915\\u0902\\u092a\\u094d\\u092f\\u0942\\u091f\\u0930 \\u0915\\u093e\\u0928\\u0942\\u0928<\\/li>\\r\\n<\\/ul>","ar":"<ul>\\r\\n\\t<li>\\u0645\\u0642\\u062f\\u0645\\u0629 \\u0641\\u064a \\u0627\\u0644\\u0642\\u0627\\u0646\\u0648\\u0646 \\u0627\\u0644\\u062c\\u0646\\u0627\\u0626\\u064a<\\/li>\\r\\n\\t<li>\\u0625\\u062c\\u0631\\u0627\\u0621\\u0627\\u062a \\u0627\\u0644\\u0642\\u0627\\u0646\\u0648\\u0646 \\u0627\\u0644\\u062c\\u0646\\u0627\\u0626\\u064a<\\/li>\\r\\n\\t<li>\\u0627\\u0644\\u062c\\u0631\\u064a\\u0645\\u0629 \\u0630\\u0627\\u062a \\u0627\\u0644\\u064a\\u0627\\u0642\\u0648\\u062a \\u0627\\u0644\\u0623\\u0628\\u064a\\u0636<\\/li>\\r\\n\\t<li>\\u062c\\u0631\\u064a\\u0645\\u0629 \\u0627\\u0644\\u0625\\u0646\\u062a\\u0631\\u0646\\u062a \\u0648\\u0642\\u0627\\u0646\\u0648\\u0646 \\u0627\\u0644\\u062d\\u0627\\u0633\\u0648\\u0628<\\/li>\\r\\n<\\/ul>"}',
                'id' => 1,
                'image' => '/images/service_categories/664745efe249d.png',
                'is_active' => 1,
                'name' => '{"en":"Criminal Law","hi":"\\u092b\\u094c\\u091c\\u0926\\u093e\\u0930\\u0940 \\u0915\\u093e\\u0928\\u0942\\u0928","ar":"\\u0642\\u0627\\u0646\\u0648\\u0646 \\u062c\\u0646\\u0627\\u0626\\u064a"}',
                'slug' => 'criminal-law-1',
                'sort_order' => NULL,
                'updated_at' => '2024-05-17 16:56:31',
            ),
            1 => 
            array (
                'created_at' => '2023-11-02 18:52:14',
                'deleted_at' => '2023-11-02 18:52:24',
                'description' => '{"en":"dasdas","hi":"dasdas","ar":"asdasd"}',
                'id' => 2,
                'image' => '/images/archive_categories/6543a98e6fd69.png',
                'is_active' => 1,
                'name' => '{"en":"asdas","hi":"sdas","ar":"asd"}',
                'slug' => 'asdas-2',
                'sort_order' => NULL,
                'updated_at' => '2023-11-02 18:52:24',
            ),
            2 => 
            array (
                'created_at' => '2023-11-02 18:52:50',
                'deleted_at' => '2023-11-02 18:52:59',
                'description' => '{"en":"asdasd","hi":"asdasd","ar":"asdasdasdad"}',
                'id' => 3,
                'image' => '/images/archive_categories/6543a9b29612d.png',
                'is_active' => 1,
                'name' => '{"en":"Religious Freedom and Expression","hi":"\\u0936\\u093f\\u0915\\u094d\\u0937\\u093e \\u0915\\u093e\\u0928\\u0942\\u0928","ar":"\\u0627\\u0644\\u062d\\u0631\\u064a\\u0629 \\u0627\\u0644\\u062f\\u064a\\u0646\\u064a\\u0629 \\u0648\\u0627\\u0644\\u062a\\u0639\\u0628\\u064a\\u0631"}',
                'slug' => 'religious-freedom-and-expression-3',
                'sort_order' => NULL,
                'updated_at' => '2023-11-02 18:52:59',
            ),
            3 => 
            array (
                'created_at' => '2023-11-03 15:06:31',
                'deleted_at' => '2023-11-03 15:07:25',
                'description' => '{"en":"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.","hi":"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.","ar":"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur."}',
                'id' => 4,
                'image' => '/images/archive_categories/6544c627836f7.png',
                'is_active' => 1,
                'name' => '{"en":"Religious Freedom and Expression","hi":"\\u0927\\u093e\\u0930\\u094d\\u092e\\u093f\\u0915 \\u0938\\u094d\\u0935\\u0924\\u0902\\u0924\\u094d\\u0930\\u0924\\u093e \\u0914\\u0930 \\u0905\\u092d\\u093f\\u0935\\u094d\\u092f\\u0915\\u094d\\u0924\\u093f","ar":"\\u0627\\u0644\\u062d\\u0631\\u064a\\u0629 \\u0627\\u0644\\u062f\\u064a\\u0646\\u064a\\u0629 \\u0648\\u0627\\u0644\\u062a\\u0639\\u0628\\u064a\\u0631"}',
                'slug' => 'religious-freedom-and-expression-4',
                'sort_order' => NULL,
                'updated_at' => '2023-11-03 15:07:25',
            ),
            4 => 
            array (
                'created_at' => '2024-05-14 14:33:20',
                'deleted_at' => NULL,
                'description' => '{"en":"<p>Regulation law, often referred to simply as regulatory law, encompasses the legal principles governing the activities of administrative agencies of government. It involves the procedures, rules, and regulations that these agencies create and enforce to ensure compliance with laws enacted by<\\/p>","hi":"<p>sdfdsfd<\\/p>","ar":"<p>sdfdsfdf<\\/p>"}',
                'id' => 5,
                'image' => '/images/service_categories/6647455797cc4.png',
                'is_active' => 1,
                'name' => '{"en":"Regulation Law","hi":"Walter Robbins","ar":"Christen Kline"}',
                'slug' => 'regulation-law-5',
                'sort_order' => NULL,
                'updated_at' => '2024-05-17 16:53:59',
            ),
            5 => 
            array (
                'created_at' => '2024-05-17 17:01:51',
                'deleted_at' => '2024-05-17 17:04:39',
                'description' => '{"en":"<p>Legal professionals help clients secure trademarks to protect their brand names, logos, and other identifying marks. This involves conducting trademark searches, preparing and filing trademark applications, and responding to any issues that arise during the registration process.<\\/p>","hi":"<p>\\u0915\\u093e\\u0928\\u0942\\u0928\\u0940 \\u092a\\u0947\\u0936\\u0947\\u0935\\u0930 \\u0917\\u094d\\u0930\\u093e\\u0939\\u0915\\u094b\\u0902 \\u0915\\u094b \\u0909\\u0928\\u0915\\u0947 \\u092c\\u094d\\u0930\\u093e\\u0902\\u0921 \\u0928\\u093e\\u092e, \\u0932\\u094b\\u0917\\u094b \\u0914\\u0930 \\u0905\\u0928\\u094d\\u092f \\u092a\\u0939\\u091a\\u093e\\u0928\\u0928\\u0947 \\u092f\\u094b\\u0917\\u094d\\u092f \\u091a\\u093f\\u0939\\u094d\\u0928\\u094b\\u0902 \\u0915\\u0940 \\u0938\\u0941\\u0930\\u0915\\u094d\\u0937\\u093e \\u0915\\u0947 \\u0932\\u093f\\u090f \\u091f\\u094d\\u0930\\u0947\\u0921\\u092e\\u093e\\u0930\\u094d\\u0915 \\u092a\\u094d\\u0930\\u093e\\u092a\\u094d\\u0924 \\u0915\\u0930\\u0928\\u0947 \\u092e\\u0947\\u0902 \\u0938\\u0939\\u093e\\u092f\\u0924\\u093e \\u0915\\u0930\\u0924\\u0947 \\u0939\\u0948\\u0902\\u0964 \\u0907\\u0938\\u092e\\u0947\\u0902 \\u091f\\u094d\\u0930\\u0947\\u0921\\u092e\\u093e\\u0930\\u094d\\u0915 \\u0916\\u094b\\u091c \\u0915\\u0930\\u0928\\u093e, \\u091f\\u094d\\u0930\\u0947\\u0921\\u092e\\u093e\\u0930\\u094d\\u0915 \\u0906\\u0935\\u0947\\u0926\\u0928 \\u0924\\u0948\\u092f\\u093e\\u0930 \\u0915\\u0930\\u0928\\u093e \\u0914\\u0930 \\u0926\\u093e\\u0916\\u093f\\u0932 \\u0915\\u0930\\u0928\\u093e, \\u0914\\u0930 \\u092a\\u0902\\u091c\\u0940\\u0915\\u0930\\u0923 \\u092a\\u094d\\u0930\\u0915\\u094d\\u0930\\u093f\\u092f\\u093e \\u0915\\u0947 \\u0926\\u094c\\u0930\\u093e\\u0928 \\u0909\\u0924\\u094d\\u092a\\u0928\\u094d\\u0928 \\u0939\\u094b\\u0928\\u0947 \\u0935\\u093e\\u0932\\u0947 \\u0915\\u093f\\u0938\\u0940 \\u092d\\u0940 \\u092e\\u0941\\u0926\\u094d\\u0926\\u0947 \\u0915\\u093e \\u0938\\u092e\\u093e\\u0927\\u093e\\u0928 \\u0915\\u0930\\u0928\\u093e \\u0936\\u093e\\u092e\\u093f\\u0932 \\u0939\\u0948\\u0964<\\/p>","ar":"<p>\\u064a\\u0633\\u0627\\u0639\\u062f \\u0627\\u0644\\u0645\\u062d\\u0627\\u0645\\u0648\\u0646 \\u0627\\u0644\\u0645\\u062d\\u062a\\u0631\\u0641\\u0648\\u0646 \\u0627\\u0644\\u0639\\u0645\\u0644\\u0627\\u0621 \\u0641\\u064a \\u062a\\u0623\\u0645\\u064a\\u0646 \\u0627\\u0644\\u0639\\u0644\\u0627\\u0645\\u0627\\u062a \\u0627\\u0644\\u062a\\u062c\\u0627\\u0631\\u064a\\u0629 \\u0644\\u062d\\u0645\\u0627\\u064a\\u0629 \\u0623\\u0633\\u0645\\u0627\\u0621 \\u0639\\u0644\\u0627\\u0645\\u0627\\u062a\\u0647\\u0645 \\u0627\\u0644\\u062a\\u062c\\u0627\\u0631\\u064a\\u0629 \\u0648\\u0627\\u0644\\u0634\\u0639\\u0627\\u0631\\u0627\\u062a \\u0648\\u0627\\u0644\\u0639\\u0644\\u0627\\u0645\\u0627\\u062a \\u0627\\u0644\\u0623\\u062e\\u0631\\u0649 \\u0627\\u0644\\u0645\\u0645\\u064a\\u0632\\u0629. \\u064a\\u062a\\u0636\\u0645\\u0646 \\u0630\\u0644\\u0643 \\u0625\\u062c\\u0631\\u0627\\u0621 \\u0639\\u0645\\u0644\\u064a\\u0627\\u062a \\u0627\\u0644\\u0628\\u062d\\u062b \\u0639\\u0646 \\u0627\\u0644\\u0639\\u0644\\u0627\\u0645\\u0627\\u062a \\u0627\\u0644\\u062a\\u062c\\u0627\\u0631\\u064a\\u0629\\u060c \\u0625\\u0639\\u062f\\u0627\\u062f \\u0648\\u062a\\u0642\\u062f\\u064a\\u0645 \\u0637\\u0644\\u0628\\u0627\\u062a \\u0627\\u0644\\u0639\\u0644\\u0627\\u0645\\u0627\\u062a \\u0627\\u0644\\u062a\\u062c\\u0627\\u0631\\u064a\\u0629\\u060c \\u0648\\u0627\\u0644\\u0631\\u062f \\u0639\\u0644\\u0649 \\u0623\\u064a \\u0645\\u0633\\u0627\\u0626\\u0644 \\u0642\\u062f \\u062a\\u0646\\u0634\\u0623 \\u062e\\u0644\\u0627\\u0644 \\u0639\\u0645\\u0644\\u064a\\u0629 \\u0627\\u0644\\u062a\\u0633\\u062c\\u064a\\u0644.<\\/p>"}',
                'id' => 6,
                'image' => '/images/service_categories/6647472f78016.png',
                'is_active' => 0,
                'name' => '{"en":"Trademark Registration","hi":"\\u091f\\u094d\\u0930\\u0947\\u0921\\u092e\\u093e\\u0930\\u094d\\u0915 \\u092a\\u0902\\u091c\\u0940\\u0915\\u0930\\u0923","ar":"\\u062a\\u0633\\u062c\\u064a\\u0644 \\u0627\\u0644\\u0639\\u0644\\u0627\\u0645\\u0627\\u062a \\u0627\\u0644\\u062a\\u062c\\u0627\\u0631\\u064a\\u0629"}',
                'slug' => 'trademark-registration-6',
                'sort_order' => NULL,
                'updated_at' => '2024-05-17 17:04:39',
            ),
            6 => 
            array (
                'created_at' => '2024-05-17 17:01:51',
                'deleted_at' => NULL,
                'description' => '{"en":"<p>Legal professionals help clients secure trademarks to protect their brand names, logos, and other identifying marks. This involves conducting trademark searches, preparing and filing trademark applications, and responding to any issues that arise during the registration process.<\\/p>","hi":"<p>\\u0915\\u093e\\u0928\\u0942\\u0928\\u0940 \\u092a\\u0947\\u0936\\u0947\\u0935\\u0930 \\u0917\\u094d\\u0930\\u093e\\u0939\\u0915\\u094b\\u0902 \\u0915\\u094b \\u0909\\u0928\\u0915\\u0947 \\u092c\\u094d\\u0930\\u093e\\u0902\\u0921 \\u0928\\u093e\\u092e, \\u0932\\u094b\\u0917\\u094b \\u0914\\u0930 \\u0905\\u0928\\u094d\\u092f \\u092a\\u0939\\u091a\\u093e\\u0928\\u0928\\u0947 \\u092f\\u094b\\u0917\\u094d\\u092f \\u091a\\u093f\\u0939\\u094d\\u0928\\u094b\\u0902 \\u0915\\u0940 \\u0938\\u0941\\u0930\\u0915\\u094d\\u0937\\u093e \\u0915\\u0947 \\u0932\\u093f\\u090f \\u091f\\u094d\\u0930\\u0947\\u0921\\u092e\\u093e\\u0930\\u094d\\u0915 \\u092a\\u094d\\u0930\\u093e\\u092a\\u094d\\u0924 \\u0915\\u0930\\u0928\\u0947 \\u092e\\u0947\\u0902 \\u0938\\u0939\\u093e\\u092f\\u0924\\u093e \\u0915\\u0930\\u0924\\u0947 \\u0939\\u0948\\u0902\\u0964 \\u0907\\u0938\\u092e\\u0947\\u0902 \\u091f\\u094d\\u0930\\u0947\\u0921\\u092e\\u093e\\u0930\\u094d\\u0915 \\u0916\\u094b\\u091c \\u0915\\u0930\\u0928\\u093e, \\u091f\\u094d\\u0930\\u0947\\u0921\\u092e\\u093e\\u0930\\u094d\\u0915 \\u0906\\u0935\\u0947\\u0926\\u0928 \\u0924\\u0948\\u092f\\u093e\\u0930 \\u0915\\u0930\\u0928\\u093e \\u0914\\u0930 \\u0926\\u093e\\u0916\\u093f\\u0932 \\u0915\\u0930\\u0928\\u093e, \\u0914\\u0930 \\u092a\\u0902\\u091c\\u0940\\u0915\\u0930\\u0923 \\u092a\\u094d\\u0930\\u0915\\u094d\\u0930\\u093f\\u092f\\u093e \\u0915\\u0947 \\u0926\\u094c\\u0930\\u093e\\u0928 \\u0909\\u0924\\u094d\\u092a\\u0928\\u094d\\u0928 \\u0939\\u094b\\u0928\\u0947 \\u0935\\u093e\\u0932\\u0947 \\u0915\\u093f\\u0938\\u0940 \\u092d\\u0940 \\u092e\\u0941\\u0926\\u094d\\u0926\\u0947 \\u0915\\u093e \\u0938\\u092e\\u093e\\u0927\\u093e\\u0928 \\u0915\\u0930\\u0928\\u093e \\u0936\\u093e\\u092e\\u093f\\u0932 \\u0939\\u0948\\u0964<\\/p>","ar":"<p>\\u064a\\u0633\\u0627\\u0639\\u062f \\u0627\\u0644\\u0645\\u062d\\u0627\\u0645\\u0648\\u0646 \\u0627\\u0644\\u0645\\u062d\\u062a\\u0631\\u0641\\u0648\\u0646 \\u0627\\u0644\\u0639\\u0645\\u0644\\u0627\\u0621 \\u0641\\u064a \\u062a\\u0623\\u0645\\u064a\\u0646 \\u0627\\u0644\\u0639\\u0644\\u0627\\u0645\\u0627\\u062a \\u0627\\u0644\\u062a\\u062c\\u0627\\u0631\\u064a\\u0629 \\u0644\\u062d\\u0645\\u0627\\u064a\\u0629 \\u0623\\u0633\\u0645\\u0627\\u0621 \\u0639\\u0644\\u0627\\u0645\\u0627\\u062a\\u0647\\u0645 \\u0627\\u0644\\u062a\\u062c\\u0627\\u0631\\u064a\\u0629 \\u0648\\u0627\\u0644\\u0634\\u0639\\u0627\\u0631\\u0627\\u062a \\u0648\\u0627\\u0644\\u0639\\u0644\\u0627\\u0645\\u0627\\u062a \\u0627\\u0644\\u0623\\u062e\\u0631\\u0649 \\u0627\\u0644\\u0645\\u0645\\u064a\\u0632\\u0629. \\u064a\\u062a\\u0636\\u0645\\u0646 \\u0630\\u0644\\u0643 \\u0625\\u062c\\u0631\\u0627\\u0621 \\u0639\\u0645\\u0644\\u064a\\u0627\\u062a \\u0627\\u0644\\u0628\\u062d\\u062b \\u0639\\u0646 \\u0627\\u0644\\u0639\\u0644\\u0627\\u0645\\u0627\\u062a \\u0627\\u0644\\u062a\\u062c\\u0627\\u0631\\u064a\\u0629\\u060c \\u0625\\u0639\\u062f\\u0627\\u062f \\u0648\\u062a\\u0642\\u062f\\u064a\\u0645 \\u0637\\u0644\\u0628\\u0627\\u062a \\u0627\\u0644\\u0639\\u0644\\u0627\\u0645\\u0627\\u062a \\u0627\\u0644\\u062a\\u062c\\u0627\\u0631\\u064a\\u0629\\u060c \\u0648\\u0627\\u0644\\u0631\\u062f \\u0639\\u0644\\u0649 \\u0623\\u064a \\u0645\\u0633\\u0627\\u0626\\u0644 \\u0642\\u062f \\u062a\\u0646\\u0634\\u0623 \\u062e\\u0644\\u0627\\u0644 \\u0639\\u0645\\u0644\\u064a\\u0629 \\u0627\\u0644\\u062a\\u0633\\u062c\\u064a\\u0644.<\\/p>"}',
                'id' => 7,
                'image' => '/images/service_categories/6647472fac8ea.png',
                'is_active' => 1,
                'name' => '{"en":"Trademark Register","hi":"\\u091f\\u094d\\u0930\\u0947\\u0921\\u092e\\u093e\\u0930\\u094d\\u0915 \\u092a\\u0902\\u091c\\u0940\\u0915\\u0930\\u0923","ar":"\\u062a\\u0633\\u062c\\u064a\\u0644 \\u0627\\u0644\\u0639\\u0644\\u0627\\u0645\\u0627\\u062a \\u0627\\u0644\\u062a\\u062c\\u0627\\u0631\\u064a\\u0629"}',
                'slug' => 'trademark-register-7',
                'sort_order' => NULL,
                'updated_at' => '2024-05-17 17:04:30',
            ),
        ));
        
        
    }
}