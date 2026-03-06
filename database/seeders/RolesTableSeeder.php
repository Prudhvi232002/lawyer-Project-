<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('roles')->delete();
        
        \DB::table('roles')->insert(array (
            0 => 
            array (
                'created_at' => '2023-01-04 23:13:02',
                'deleted_at' => NULL,
                'description' => 'Super Admin',
                'icon' => 'ok',
                'id' => 9,
                'is_active' => 1,
                'is_editable' => 0,
                'name' => 'SuperAdmin',
                'role_code' => 'super_admin',
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'created_at' => '2023-01-04 23:13:02',
                'deleted_at' => NULL,
                'description' => 'Admin',
                'icon' => 'ok',
                'id' => 11,
                'is_active' => 1,
                'is_editable' => 0,
                'name' => 'Admin',
                'role_code' => 'admin',
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'created_at' => '2023-01-04 23:13:02',
                'deleted_at' => NULL,
                'description' => 'lawyer',
                'icon' => 'ok',
                'id' => 12,
                'is_active' => 1,
                'is_editable' => 0,
                'name' => 'Lawyer',
                'role_code' => 'lawyer',
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'created_at' => '2023-01-04 23:13:02',
                'deleted_at' => NULL,
                'description' => 'customer',
                'icon' => 'ok',
                'id' => 13,
                'is_active' => 1,
                'is_editable' => 0,
                'name' => 'Customer',
                'role_code' => 'customer',
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'created_at' => '2023-01-05 03:13:02',
                'deleted_at' => NULL,
                'description' => 'law_firm',
                'icon' => 'ok',
                'id' => 14,
                'is_active' => 1,
                'is_editable' => 0,
                'name' => 'LawFirm',
                'role_code' => 'law_firm',
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}