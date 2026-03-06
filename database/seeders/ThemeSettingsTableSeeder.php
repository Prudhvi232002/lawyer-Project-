<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ThemeSettingsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('theme_settings')->delete();
        
        \DB::table('theme_settings')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'custom_primary_color',
                'color' => 'primary_color',
                'display_name' => 'Custom Primary color',
                'value' => '#cab083',
                'theme_code' => 'custom',
                'is_editable' => 1,
                'is_protected' => 0,
                'is_specific' => 1,
                'is_multilang' => 0,
                'type' => 'color',
                'page' => 'theme',
                'image' => NULL,
                'is_active' => 0,
                'created_at' => '2025-01-16 13:42:16',
                'updated_at' => '2025-01-16 13:42:16',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'custom_secondary_color',
                'color' => 'secondary_color',
                'display_name' => 'Custom Secondary Color',
                'value' => '#003c40',
                'theme_code' => 'custom',
                'is_editable' => 1,
                'is_protected' => 0,
                'is_specific' => 1,
                'is_multilang' => 0,
                'type' => 'color',
                'page' => 'theme',
                'image' => NULL,
                'is_active' => 0,
                'created_at' => '2025-01-16 13:42:16',
                'updated_at' => '2025-01-16 13:42:16',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'theme_1_primary_color',
                'color' => 'primary_color',
                'display_name' => 'Theme 1 Primary Color',
                'value' => '#f66e00',
                'theme_code' => 'theme_1',
                'is_editable' => 0,
                'is_protected' => 0,
                'is_specific' => 1,
                'is_multilang' => 0,
                'type' => 'color',
                'page' => 'theme',
                'image' => '/images/themes/theme_1.jpg',
                'is_active' => 1,
                'created_at' => '2025-01-16 13:42:16',
                'updated_at' => '2025-01-16 13:42:16',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'theme_1_secondary_color',
                'color' => 'secondary_color',
                'display_name' => 'theme 1 Secondary color',
                'value' => '#483f3b',
                'theme_code' => 'theme_1',
                'is_editable' => 0,
                'is_protected' => 0,
                'is_specific' => 1,
                'is_multilang' => 0,
                'type' => 'color',
                'page' => 'theme',
                'image' => '/images/themes/theme_1.jpg',
                'is_active' => 1,
                'created_at' => '2025-01-16 13:42:16',
                'updated_at' => '2025-01-16 13:42:16',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'theme_2_primary_color',
                'color' => 'primary_color',
                'display_name' => 'Theme 2 Primary Color',
                'value' => '#CBA672',
                'theme_code' => 'theme_2',
                'is_editable' => 0,
                'is_protected' => 0,
                'is_specific' => 1,
                'is_multilang' => 0,
                'type' => 'color',
                'page' => 'theme',
                'image' => '/images/themes/theme_2.jpg',
                'is_active' => 0,
                'created_at' => '2025-01-16 13:42:16',
                'updated_at' => '2025-01-16 13:42:16',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'theme_2_secondary_color',
                'color' => 'secondary_color',
                'display_name' => 'theme 2 Secondary color',
                'value' => '#003C40',
                'theme_code' => 'theme_2',
                'is_editable' => 0,
                'is_protected' => 0,
                'is_specific' => 1,
                'is_multilang' => 0,
                'type' => 'color',
                'page' => 'theme',
                'image' => '/images/themes/theme_2.jpg',
                'is_active' => 0,
                'created_at' => '2025-01-16 13:42:16',
                'updated_at' => '2025-01-16 13:42:16',
            ),
            6 => 
            array (
                'id' => 8,
                'name' => 'default_primary_color',
                'color' => 'primary_color',
                'display_name' => 'Default Primary Color',
                'value' => '#cab083',
                'theme_code' => 'default',
                'is_editable' => 0,
                'is_protected' => 0,
                'is_specific' => 1,
                'is_multilang' => 0,
                'type' => 'color',
                'page' => 'theme',
                'image' => '/images/themes/default.jpg',
                'is_active' => 0,
                'created_at' => '2025-01-16 13:42:16',
                'updated_at' => '2025-01-16 13:42:16',
            ),
            7 => 
            array (
                'id' => 9,
                'name' => 'default_secondary_color',
                'color' => 'secondary_color',
                'display_name' => 'Default Secondary Color',
                'value' => '#262929',
                'theme_code' => 'default',
                'is_editable' => 0,
                'is_protected' => 0,
                'is_specific' => 1,
                'is_multilang' => 0,
                'type' => 'color',
                'page' => 'theme',
                'image' => '/images/themes/default.jpg',
                'is_active' => 0,
                'created_at' => '2025-01-16 13:42:16',
                'updated_at' => '2025-01-16 13:42:16',
            ),
            8 => 
            array (
                'id' => 10,
                'name' => 'custom_tertiary_color',
                'color' => 'tertiary_color',
                'display_name' => 'Custom Tertiary Color',
                'value' => '#cee6e7',
                'theme_code' => 'custom',
                'is_editable' => 1,
                'is_protected' => 0,
                'is_specific' => 1,
                'is_multilang' => 0,
                'type' => 'color',
                'page' => 'theme',
                'image' => NULL,
                'is_active' => 0,
                'created_at' => '2025-01-16 13:42:16',
                'updated_at' => '2025-01-16 13:42:16',
            ),
            9 => 
            array (
                'id' => 11,
                'name' => 'theme_1_tertiary_color',
                'color' => 'tertiary_color',
                'display_name' => 'theme 1 Tertiary color',
                'value' => '#F1EAE7',
                'theme_code' => 'theme_1',
                'is_editable' => 0,
                'is_protected' => 0,
                'is_specific' => 1,
                'is_multilang' => 0,
                'type' => 'color',
                'page' => 'theme',
                'image' => '/images/themes/theme_1.jpg',
                'is_active' => 1,
                'created_at' => '2025-01-16 13:42:16',
                'updated_at' => '2025-01-16 13:42:16',
            ),
            10 => 
            array (
                'id' => 12,
                'name' => 'theme_2_tertiary_color',
                'color' => 'tertiary_color',
                'display_name' => 'theme 2 Tertiary color',
                'value' => '#cee6e7',
                'theme_code' => 'theme_2',
                'is_editable' => 0,
                'is_protected' => 0,
                'is_specific' => 1,
                'is_multilang' => 0,
                'type' => 'color',
                'page' => 'theme',
                'image' => '/images/themes/theme_2.jpg',
                'is_active' => 0,
                'created_at' => '2025-01-16 13:42:16',
                'updated_at' => '2025-01-16 13:42:16',
            ),
            11 => 
            array (
                'id' => 13,
                'name' => 'default_tertiary_color',
                'color' => 'tertiary_color',
                'display_name' => 'Default Tertiary Color',
                'value' => '#FCECCB',
                'theme_code' => 'default',
                'is_editable' => 0,
                'is_protected' => 0,
                'is_specific' => 1,
                'is_multilang' => 0,
                'type' => 'color',
                'page' => 'theme',
                'image' => '/images/themes/default.jpg',
                'is_active' => 0,
                'created_at' => '2025-01-16 13:42:16',
                'updated_at' => '2025-01-16 13:42:16',
            ),
        ));
        
        
    }
}