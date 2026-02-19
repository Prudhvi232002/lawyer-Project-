<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ServiceFaqsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('service_faqs')->delete();
        
        \DB::table('service_faqs')->insert(array (
            0 => 
            array (
                'answer' => '{"en":"A lawyer directory is an online or printed resource that lists lawyers, law firms, and legal professionals. These directories typically include contact information, areas of practice, credentials, and sometimes client reviews and ratings."}',
                'created_at' => '2024-05-14 18:55:08',
                'deleted_at' => NULL,
                'id' => 1,
                'image' => NULL,
                'is_active' => 1,
                'question' => '{"en":"What is a lawyer directory?"}',
                'service_id' => 6,
                'sort_order' => NULL,
                'updated_at' => '2024-05-14 18:55:08',
            ),
            1 => 
            array (
                'answer' => '{"en":"Paralegal services are professional legal assistance provided by trained individuals known as paralegals. They support lawyers by conducting legal research, drafting documents, organizing files, and managing cases, among other tasks."}',
                'created_at' => '2024-05-14 18:57:44',
                'deleted_at' => '2024-05-14 18:58:41',
                'id' => 2,
                'image' => NULL,
                'is_active' => 1,
                'question' => '{"en":"What are paralegal services?"}',
                'service_id' => 7,
                'sort_order' => NULL,
                'updated_at' => '2024-05-14 18:58:41',
            ),
            2 => 
            array (
                'answer' => '{"en":"Paralegal services are professional legal assistance provided by trained individuals known as paralegals. They support lawyers by conducting legal research, drafting documents, organizing files, and managing cases, among other tasks."}',
                'created_at' => '2024-05-14 18:58:41',
                'deleted_at' => NULL,
                'id' => 3,
                'image' => NULL,
                'is_active' => 1,
                'question' => '{"en":"What are paralegal services?"}',
                'service_id' => 7,
                'sort_order' => NULL,
                'updated_at' => '2024-05-14 18:58:41',
            ),
            3 => 
            array (
                'answer' => '{"en":"Court filings are legal documents submitted to the court in connection with a case. These documents include complaints, motions, briefs, and other papers necessary for the legal process."}',
                'created_at' => '2024-05-14 19:00:58',
                'deleted_at' => '2024-05-16 16:51:57',
                'id' => 4,
                'image' => NULL,
                'is_active' => 1,
                'question' => '{"en":"What are court filings?"}',
                'service_id' => 8,
                'sort_order' => NULL,
                'updated_at' => '2024-05-16 16:51:57',
            ),
            4 => 
            array (
                'answer' => '{"en":"Court filings are legal documents submitted to the court in connection with a case. These documents include complaints, motions, briefs, and other papers necessary for the legal process."}',
                'created_at' => '2024-05-16 16:51:57',
                'deleted_at' => NULL,
                'id' => 5,
                'image' => NULL,
                'is_active' => 1,
                'question' => '{"en":"What are court filings?"}',
                'service_id' => 8,
                'sort_order' => NULL,
                'updated_at' => '2024-05-16 16:51:57',
            ),
            5 => 
            array (
                'answer' => '{"en":"Yes, in many jurisdictions, filing documents with the court requires payment of a filing fee. The amount depends on the type of document and the court\'s fee schedule. Some parties may qualify for fee waivers based on financial hardship."}',
                'created_at' => '2024-05-16 16:51:57',
                'deleted_at' => NULL,
                'id' => 6,
                'image' => NULL,
                'is_active' => 1,
                'question' => '{"en":"Do I have to pay a fee to file documents with the court?"}',
                'service_id' => 8,
                'sort_order' => NULL,
                'updated_at' => '2024-05-16 16:51:57',
            ),
        ));
        
        
    }
}