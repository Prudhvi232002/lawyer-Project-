<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BroadcastCategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('broadcast_categories')->delete();
        
        \DB::table('broadcast_categories')->insert(array (
            0 => 
            array (
                'created_at' => '2023-11-01 19:23:02',
                'deleted_at' => '2023-11-02 14:47:36',
                'description' => '{"en":"dasd","hi":"asdasd","ar":"asdasd"}',
                'id' => 1,
                'image' => NULL,
                'is_active' => 1,
                'name' => '{"en":"asdas","hi":"asd","ar":"sadasd"}',
                'slug' => 'asdas-1',
                'sort_order' => NULL,
                'updated_at' => '2023-11-02 14:47:36',
            ),
            1 => 
            array (
                'created_at' => '2023-11-02 14:51:45',
                'deleted_at' => '2023-11-02 14:56:23',
                'description' => '{"en":"sadasdasd","hi":"sdasd","ar":"sdasdsad"}',
                'id' => 2,
                'image' => '/images/broadcast_categories/654371319f4e8.png',
                'is_active' => 1,
                'name' => '{"en":"Advertising Law","hi":"asdasda","ar":"asdasda"}',
                'slug' => 'advertising-law-2',
                'sort_order' => NULL,
                'updated_at' => '2023-11-02 14:56:23',
            ),
            2 => 
            array (
                'created_at' => '2023-11-02 18:39:43',
                'deleted_at' => '2023-11-02 18:39:52',
                'description' => '{"en":"asdasd","hi":"dasdasdasdasd","ar":"asdasd"}',
                'id' => 3,
                'image' => '/images/broadcast_categories/6543a69f3490c.png',
                'is_active' => 1,
                'name' => '{"en":"asdasd","hi":"dasdasd","ar":"dasdasd"}',
                'slug' => 'asdasd-3',
                'sort_order' => NULL,
                'updated_at' => '2023-11-02 18:39:52',
            ),
            3 => 
            array (
                'created_at' => '2023-11-02 18:48:48',
                'deleted_at' => '2023-11-02 18:54:16',
                'description' => '{"en":"dasdasd","hi":"asdasd","ar":"asdasdasdasd"}',
                'id' => 4,
                'image' => NULL,
                'is_active' => 1,
                'name' => '{"en":"asdas","hi":"asdasd","ar":"asdasd"}',
                'slug' => 'asdas-4',
                'sort_order' => NULL,
                'updated_at' => '2023-11-02 18:54:16',
            ),
            4 => 
            array (
                'created_at' => '2023-11-02 19:24:25',
                'deleted_at' => '2023-11-02 19:24:32',
                'description' => '{"en":"fdfdfgd","hi":"retret","ar":"retretrt"}',
                'id' => 5,
                'image' => '/images/broadcast_categories/6543b1196299a.png',
                'is_active' => 1,
                'name' => '{"en":"dsfdsdf","hi":"ertret","ar":"ertert"}',
                'slug' => 'dsfdsdf-5',
                'sort_order' => NULL,
                'updated_at' => '2023-11-02 19:24:32',
            ),
            5 => 
            array (
                'created_at' => '2023-11-02 19:44:57',
                'deleted_at' => '2023-11-02 19:46:11',
                'description' => '{"en":"wewe","hi":"wewewe","ar":"wewewe"}',
                'id' => 6,
                'image' => '/images/broadcast_categories/6543b5e9596de.png',
                'is_active' => 1,
                'name' => '{"en":"wewe","hi":"wewe","ar":"wewewe"}',
                'slug' => 'wewe-6',
                'sort_order' => NULL,
                'updated_at' => '2023-11-02 19:46:11',
            ),
            6 => 
            array (
                'created_at' => '2023-11-02 19:45:21',
                'deleted_at' => '2023-11-02 19:46:06',
                'description' => '{"en":"ert","hi":"rert","ar":"ertret"}',
                'id' => 7,
                'image' => '/images/broadcast_categories/6543b601c8ba1.png',
                'is_active' => 1,
                'name' => '{"en":"erter","hi":"tt","ar":"ertert"}',
                'slug' => 'erter-7',
                'sort_order' => NULL,
                'updated_at' => '2023-11-02 19:46:06',
            ),
            7 => 
            array (
                'created_at' => '2023-11-02 19:47:48',
                'deleted_at' => '2023-11-02 19:47:55',
                'description' => '{"en":"aa","hi":"aa","ar":"aaa"}',
                'id' => 8,
                'image' => '/images/broadcast_categories/6543b694e5b4c.png',
                'is_active' => 1,
                'name' => '{"en":"aa","hi":"aa","ar":"aa"}',
                'slug' => 'aa-8',
                'sort_order' => NULL,
                'updated_at' => '2023-11-02 19:47:55',
            ),
            8 => 
            array (
                'created_at' => '2023-11-02 19:55:48',
                'deleted_at' => '2023-11-02 19:56:33',
                'description' => '{"en":"Upon successfully creating a new customer, you gain the additional capability to \'View Customer\' after the profile has been generated. This function grants you access to a detailed profile view, offering a comprehensive overview of each customer\'s information. This invaluable feature streamlines the process of swiftly retrieving and reviewing customer data whenever the need arises","hi":"Upon successfully creating a new customer, you gain the additional capability to \'View Customer\' after the profile has been generated. This function grants you access to a detailed profile view, offering a comprehensive overview of each customer\'s information. This invaluable feature streamlines the process of swiftly retrieving and reviewing customer data whenever the need arises","ar":"Upon successfully creating a new customer, you gain the additional capability to \'View Customer\' after the profile has been generated. This function grants you access to a detailed profile view, offering a comprehensive overview of each customer\'s information. This invaluable feature streamlines the process of swiftly retrieving and reviewing customer data whenever the need arises"}',
                'id' => 9,
                'image' => '/images/broadcast_categories/6543b874c326c.png',
                'is_active' => 1,
                'name' => '{"en":"Religious Freedom and Expression","hi":"\\u0936\\u093f\\u0915\\u094d\\u0937\\u093e \\u0915\\u093e\\u0928\\u0942\\u0928","ar":"\\u0627\\u0644\\u062d\\u0631\\u064a\\u0629 \\u0627\\u0644\\u062f\\u064a\\u0646\\u064a\\u0629 \\u0648\\u0627\\u0644\\u062a\\u0639\\u0628\\u064a\\u0631"}',
                'slug' => 'religious-freedom-and-expression-9',
                'sort_order' => NULL,
                'updated_at' => '2023-11-02 19:56:33',
            ),
            9 => 
            array (
                'created_at' => '2023-11-02 20:43:10',
                'deleted_at' => '2023-11-02 20:44:05',
                'description' => '{"en":"Upon successfully creating a new customer, you gain the additional capability to \'View Customer\' after the profile has been generated. This function grants you access to a detailed profile view, offering a comprehensive overview of each customer\'s information. This invaluable feature streamlines the process of swiftly retrieving and reviewing customer data whenever the need arises","hi":"Upon successfully creating a new customer, you gain the additional capability to \'View Customer\' after the profile has been generated. This function grants you access to a detailed profile view, offering a comprehensive overview of each customer\'s information. This invaluable feature streamlines the process of swiftly retrieving and reviewing customer data whenever the need arises","ar":"Upon successfully creating a new customer, you gain the additional capability to \'View Customer\' after the profile has been generated. This function grants you access to a detailed profile view, offering a comprehensive overview of each customer\'s information. This invaluable feature streamlines the process of swiftly retrieving and reviewing customer data whenever the need arises"}',
                'id' => 10,
                'image' => '/images/broadcast_categories/6543c38e92040.png',
                'is_active' => 1,
                'name' => '{"en":"Upon successfully creating a new customer, you gain the additional capability to \'View Customer\' after the profile has been generated. This function grants you access to a detailed profile view, offering a comprehensive overview of each customer\'s information. This invaluable feature streamlines the process of swiftly retrieving and reviewing customer data whenever the need arises","hi":"Upon successfully creating a new customer, you gain the additional capability to \'View Customer\' after the profile has been generated. This function grants you access to a detailed profile view, offering a comprehensive overview of each customer\'s information. This invaluable feature streamlines the process of swiftly retrieving and reviewing customer data whenever the need arises","ar":"Upon successfully creating a new customer, you gain the additional capability to \'View Customer\' after the profile has been generated. This function grants you access to a detailed profile view, offering a comprehensive overview of each customer\'s information. This invaluable feature streamlines the process of swiftly retrieving and reviewing customer data whenever the need arises"}',
                'slug' => 'upon-successfully-creating-a-new-customer-you-gain-the-additional-capability-to-view-customer-after-the-profile-has-been-generated-this-function-grants-you-access-to-a-detailed-profile-view-offering-a-comprehensive-overview-of-each-customers-information-this-invaluable-feature-streamlines-the-process-of-swiftly-retrieving-and-reviewing-customer-data-whenever-the-need-arises-10',
                'sort_order' => NULL,
                'updated_at' => '2023-11-02 20:44:05',
            ),
            10 => 
            array (
                'created_at' => '2023-11-02 20:43:50',
                'deleted_at' => '2023-11-02 20:44:10',
                'description' => '{"en":"Upon successfully creating a new customer, you gain the additional capability to \'View Customer\' after the profile has been generated. This function grants you access to a detailed profile view, offering a comprehensive overview of each customer\'s information. This invaluable feature streamlines the process of swiftly retrieving and reviewing customer data whenever the need arises","hi":"Upon successfully creating a new customer, you gain the additional capability to \'View Customer\' after the profile has been generated. This function grants you access to a detailed profile view, offering a comprehensive overview of each customer\'s information. This invaluable feature streamlines the process of swiftly retrieving and reviewing customer data whenever the need arises","ar":"Upon successfully creating a new customer, you gain the additional capability to \'View Customer\' after the profile has been generated. This function grants you access to a detailed profile view, offering a comprehensive overview of each customer\'s information. This invaluable feature streamlines the process of swiftly retrieving and reviewing customer data whenever the need arises"}',
                'id' => 11,
                'image' => '/images/broadcast_categories/6543c3b69abc1.png',
                'is_active' => 1,
                'name' => '{"en":"Upon successfully creating a new customer, you gain the additional capability to \'View Customer\' after the profile has been generated. This function grants you access to a detailed profile view, offering a comprehensive overview of each customer\'s information. This invaluable feature streamlines the process of swiftly retrieving and reviewing customer data whenever the need arises","hi":"Upon successfully creating a new customer, you gain the additional capability to \'View Customer\' after the profile has been generated. This function grants you access to a detailed profile view, offering a comprehensive overview of each customer\'s information. This invaluable feature streamlines the process of swiftly retrieving and reviewing customer data whenever the need arises","ar":"Upon successfully creating a new customer, you gain the additional capability to \'View Customer\' after the profile has been generated. This function grants you access to a detailed profile view, offering a comprehensive overview of each customer\'s information. This invaluable feature streamlines the process of swiftly retrieving and reviewing customer data whenever the need arises"}',
                'slug' => 'upon-successfully-creating-a-new-customer-you-gain-the-additional-capability-to-view-customer-after-the-profile-has-been-generated-this-function-grants-you-access-to-a-detailed-profile-view-offering-a-comprehensive-overview-of-each-customers-information-this-invaluable-feature-streamlines-the-process-of-swiftly-retrieving-and-reviewing-customer-data-whenever-the-need-arises-11',
                'sort_order' => NULL,
                'updated_at' => '2023-11-02 20:44:10',
            ),
            11 => 
            array (
                'created_at' => '2023-11-03 15:02:35',
                'deleted_at' => '2023-11-03 15:03:07',
                'description' => '{"en":"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.","hi":"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.","ar":"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur."}',
                'id' => 12,
                'image' => '/images/broadcast_categories/6544c53b1476f.png',
                'is_active' => 1,
                'name' => '{"en":"Religious Freedom and Expression","hi":"\\u0927\\u093e\\u0930\\u094d\\u092e\\u093f\\u0915 \\u0938\\u094d\\u0935\\u0924\\u0902\\u0924\\u094d\\u0930\\u0924\\u093e \\u0914\\u0930 \\u0905\\u092d\\u093f\\u0935\\u094d\\u092f\\u0915\\u094d\\u0924\\u093f","ar":"\\u0627\\u0644\\u062d\\u0631\\u064a\\u0629 \\u0627\\u0644\\u062f\\u064a\\u0646\\u064a\\u0629 \\u0648\\u0627\\u0644\\u062a\\u0639\\u0628\\u064a\\u0631"}',
                'slug' => 'religious-freedom-and-expression-12',
                'sort_order' => NULL,
                'updated_at' => '2023-11-03 15:03:07',
            ),
        ));
        
        
    }
}