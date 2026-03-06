<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LawFirmReviewsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('law_firm_reviews')->delete();
        
        \DB::table('law_firm_reviews')->insert(array (
            0 => 
            array (
                'comment' => 'Good communitcation',
                'communication' => 2.0,
                'created_at' => '2023-10-03 15:28:17',
                'customer_id' => 4,
                'deleted_at' => NULL,
                'experience' => 3.0,
                'id' => 1,
                'is_active' => 1,
                'is_approved' => 0,
                'is_featured' => 0,
                'law_firm_id' => 1,
                'rating' => 3.0,
                'service' => 0.0,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'comment' => 'Good , Nice ',
                'communication' => 2.0,
                'created_at' => '2023-10-03 15:28:17',
                'customer_id' => 3,
                'deleted_at' => NULL,
                'experience' => 3.0,
                'id' => 2,
                'is_active' => 1,
                'is_approved' => 0,
                'is_featured' => 0,
                'law_firm_id' => 1,
                'rating' => 4.0,
                'service' => 0.0,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'comment' => 'Good communitcation and Work',
                'communication' => 2.0,
                'created_at' => '2023-10-03 15:28:17',
                'customer_id' => 4,
                'deleted_at' => NULL,
                'experience' => 3.0,
                'id' => 3,
                'is_active' => 1,
                'is_approved' => 0,
                'is_featured' => 0,
                'law_firm_id' => 1,
                'rating' => 3.5,
                'service' => 0.0,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'comment' => 'Good , Nice ',
                'communication' => 2.0,
                'created_at' => '2023-10-03 15:28:17',
                'customer_id' => 8,
                'deleted_at' => NULL,
                'experience' => 3.0,
                'id' => 4,
                'is_active' => 1,
                'is_approved' => 0,
                'is_featured' => 0,
                'law_firm_id' => 1,
                'rating' => 4.0,
                'service' => 0.0,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}