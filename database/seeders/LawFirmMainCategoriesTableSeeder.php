<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LawFirmMainCategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('law_firm_main_categories')->delete();
        
        \DB::table('law_firm_main_categories')->insert(array (
            0 => 
            array (
                'created_at' => '2023-08-31 14:21:44',
                'deleted_at' => NULL,
                'description' => '{"en":"<p>At EduLegis Associates, we are dedicated to navigating the intricate intersection of education and law. With our headquarters located in New York, and a solid presence across [Region\\/Country], we specialize in providing comprehensive legal solutions tailored to the education sector.<\\/p>\\r\\n\\r\\n<p>Our seasoned team of education law experts is committed to advocating for educational institutions, students, teachers, and parents alike. From regulatory compliance to student rights, academic governance to special education law, we cover a diverse spectrum of legal areas that impact the realm of education.<\\/p>","hi":"<p>\\u090f\\u0921\\u094d\\u092f\\u0942\\u0932\\u0947\\u0917\\u093f\\u0938 \\u090f\\u0938\\u094b\\u0938\\u093f\\u090f\\u091f\\u094d\\u0938 \\u092e\\u0947\\u0902, \\u0939\\u092e \\u0936\\u093f\\u0915\\u094d\\u0937\\u093e \\u0914\\u0930 \\u0915\\u093e\\u0928\\u0942\\u0928 \\u0915\\u0947 \\u091c\\u091f\\u093f\\u0932 \\u0938\\u0902\\u0935\\u093e\\u0926 \\u0915\\u093e \\u0938\\u092e\\u0930\\u094d\\u0925\\u0928 \\u0915\\u0930\\u0928\\u0947 \\u0915\\u0947 \\u0932\\u093f\\u090f \\u0938\\u092e\\u0930\\u094d\\u092a\\u093f\\u0924 \\u0939\\u0948\\u0902\\u0964 \\u0939\\u092e\\u093e\\u0930\\u093e \\u092e\\u0941\\u0916\\u094d\\u092f\\u093e\\u0932\\u092f \\u0928\\u094d\\u092f\\u0942\\u092f\\u0949\\u0930\\u094d\\u0915 \\u092e\\u0947\\u0902 \\u0938\\u094d\\u0925\\u093f\\u0924 \\u0939\\u0948, \\u0914\\u0930 [\\u0915\\u094d\\u0937\\u0947\\u0924\\u094d\\u0930 \\/ \\u0926\\u0947\\u0936] \\u092e\\u0947\\u0902 \\u090f\\u0915 \\u092e\\u091c\\u092c\\u0942\\u0924 \\u0909\\u092a\\u0938\\u094d\\u0925\\u093f\\u0924\\u093f \\u0939\\u0948, \\u0939\\u092e \\u0936\\u093f\\u0915\\u094d\\u0937\\u093e \\u0915\\u094d\\u0937\\u0947\\u0924\\u094d\\u0930 \\u0915\\u0947 \\u0932\\u093f\\u090f \\u0905\\u0928\\u0941\\u0915\\u0942\\u0932\\u093f\\u0924 \\u0938\\u092e\\u094d\\u092a\\u0942\\u0930\\u094d\\u0923\\u0924: \\u0928\\u093f\\u0930\\u094d\\u0927\\u093e\\u0930\\u093f\\u0924 \\u0915\\u093e\\u0928\\u0942\\u0928\\u0940 \\u0938\\u092e\\u093e\\u0927\\u093e\\u0928 \\u092a\\u094d\\u0930\\u0926\\u093e\\u0928 \\u0915\\u0930\\u0928\\u0947 \\u092e\\u0947\\u0902 \\u0935\\u093f\\u0936\\u0947\\u0937\\u091c\\u094d\\u091e \\u0939\\u0948\\u0902\\u0964<\\/p>\\r\\n<p>\\u0939\\u092e\\u093e\\u0930\\u0940 \\u0905\\u0928\\u0941\\u092d\\u0935\\u0940 \\u0936\\u093f\\u0915\\u094d\\u0937\\u093e \\u0915\\u093e\\u0928\\u0942\\u0928 \\u0935\\u093f\\u0936\\u0947\\u0937\\u091c\\u094d\\u091e\\u094b\\u0902 \\u0915\\u0940 \\u091f\\u0940\\u092e, \\u0936\\u0948\\u0915\\u094d\\u0937\\u093f\\u0915 \\u0938\\u0902\\u0938\\u094d\\u0925\\u093e\\u0928\\u094b\\u0902, \\u091b\\u093e\\u0924\\u094d\\u0930\\u094b\\u0902, \\u0936\\u093f\\u0915\\u094d\\u0937\\u0915\\u094b\\u0902, \\u0914\\u0930 \\u092e\\u093e\\u0924\\u093e-\\u092a\\u093f\\u0924\\u093e \\u0915\\u0947 \\u0939\\u093f\\u0924 \\u0915\\u0947 \\u0932\\u093f\\u090f \\u0938\\u092e\\u0930\\u094d\\u092a\\u093f\\u0924 \\u0939\\u0948\\u0964 \\u0935\\u093f\\u0928\\u093f\\u092f\\u093e\\u092e\\u0915 \\u0905\\u0928\\u0941\\u092a\\u093e\\u0932\\u0928 \\u0938\\u0947 \\u0932\\u0947\\u0915\\u0930 \\u091b\\u093e\\u0924\\u094d\\u0930 \\u0915\\u0947 \\u0905\\u0927\\u093f\\u0915\\u093e\\u0930\\u094b\\u0902, \\u0936\\u0948\\u0915\\u094d\\u0937\\u093f\\u0915 \\u0936\\u093e\\u0938\\u0928 \\u0938\\u0947 \\u0935\\u093f\\u0936\\u0947\\u0937 \\u0936\\u093f\\u0915\\u094d\\u0937\\u093e \\u0915\\u093e\\u0928\\u0942\\u0928 \\u0924\\u0915, \\u0939\\u092e \\u0936\\u093f\\u0915\\u094d\\u0937\\u093e \\u0915\\u0947 \\u0915\\u094d\\u0937\\u0947\\u0924\\u094d\\u0930 \\u0915\\u094b \\u092a\\u094d\\u0930\\u092d\\u093e\\u0935\\u093f\\u0924 \\u0915\\u0930\\u0928\\u0947 \\u0935\\u093e\\u0932\\u0947 \\u0935\\u093f\\u092d\\u093f\\u0928\\u094d\\u0928 \\u0915\\u093e\\u0928\\u0942\\u0928\\u0940 \\u0915\\u094d\\u0937\\u0947\\u0924\\u094d\\u0930\\u094b\\u0902 \\u0915\\u094b \\u0936\\u093e\\u092e\\u093f\\u0932 \\u0915\\u0930\\u0924\\u0947 \\u0939\\u0948\\u0902\\u0964<\\/p>","ar":"<p>\\u0641\\u064a \\u0645\\u0643\\u062a\\u0628 \\u0625\\u062f\\u0648 \\u0644\\u064a\\u062c\\u064a\\u0633 \\u0644\\u0644\\u0645\\u062d\\u0627\\u0645\\u0627\\u0629\\u060c \\u0646\\u062d\\u0646 \\u0645\\u0644\\u062a\\u0632\\u0645\\u0648\\u0646 \\u0628\\u062a\\u0648\\u062c\\u064a\\u0647 \\u0627\\u0644\\u062a\\u0642\\u0627\\u0637\\u0639 \\u0627\\u0644\\u0645\\u0639\\u0642\\u062f \\u0628\\u064a\\u0646 \\u0627\\u0644\\u062a\\u0639\\u0644\\u064a\\u0645 \\u0648\\u0627\\u0644\\u0642\\u0627\\u0646\\u0648\\u0646. \\u0628\\u0645\\u0642\\u0631\\u0627\\u062a\\u0646\\u0627 \\u0641\\u064a \\u0646\\u064a\\u0648\\u064a\\u0648\\u0631\\u0643\\u060c \\u0648\\u0648\\u062c\\u0648\\u062f \\u0642\\u0648\\u064a \\u0641\\u064a [\\u0627\\u0644\\u0645\\u0646\\u0637\\u0642\\u0629\\/\\u0627\\u0644\\u0628\\u0644\\u062f]\\u060c \\u0646\\u062a\\u062e\\u0635\\u0635 \\u0641\\u064a \\u062a\\u0648\\u0641\\u064a\\u0631 \\u062d\\u0644\\u0627\\u064b \\u0642\\u0627\\u0646\\u0648\\u0646\\u064a\\u0627\\u064b \\u0634\\u0627\\u0645\\u0644\\u0627\\u064b \\u0645\\u0635\\u0645\\u0645\\u064b\\u0627 \\u062e\\u0635\\u064a\\u0635\\u064b\\u0627 \\u0644\\u0642\\u0637\\u0627\\u0639 \\u0627\\u0644\\u062a\\u0639\\u0644\\u064a\\u0645.<\\/p>\\r\\n<p>\\u0641\\u0631\\u064a\\u0642\\u0646\\u0627 \\u0627\\u0644\\u0645\\u062c\\u0631\\u0628 \\u0645\\u0646 \\u062e\\u0628\\u0631\\u0627\\u0621 \\u0642\\u0627\\u0646\\u0648\\u0646 \\u0627\\u0644\\u062a\\u0639\\u0644\\u064a\\u0645 \\u0645\\u0644\\u062a\\u0632\\u0645 \\u0628\\u0627\\u0644\\u062f\\u0641\\u0627\\u0639 \\u0639\\u0646 \\u0627\\u0644\\u0645\\u0624\\u0633\\u0633\\u0627\\u062a \\u0627\\u0644\\u062a\\u0639\\u0644\\u064a\\u0645\\u064a\\u0629\\u060c \\u0648\\u0627\\u0644\\u0637\\u0644\\u0627\\u0628\\u060c \\u0648\\u0627\\u0644\\u0645\\u0639\\u0644\\u0645\\u064a\\u0646\\u060c \\u0648\\u0627\\u0644\\u0622\\u0628\\u0627\\u0621 \\u0639\\u0644\\u0649 \\u062d\\u062f \\u0633\\u0648\\u0627\\u0621. \\u0645\\u0646 \\u0627\\u0644\\u0627\\u0645\\u062a\\u062b\\u0627\\u0644 \\u0627\\u0644\\u062a\\u0646\\u0638\\u064a\\u0645\\u064a \\u0625\\u0644\\u0649 \\u062d\\u0642\\u0648\\u0642 \\u0627\\u0644\\u0637\\u0644\\u0627\\u0628\\u060c \\u0648\\u0645\\u0646 \\u0627\\u0644\\u062d\\u0648\\u0643\\u0645\\u0629 \\u0627\\u0644\\u0623\\u0643\\u0627\\u062f\\u064a\\u0645\\u064a\\u0629 \\u0625\\u0644\\u0649 \\u0642\\u0627\\u0646\\u0648\\u0646 \\u0627\\u0644\\u062a\\u0639\\u0644\\u064a\\u0645 \\u0627\\u0644\\u062e\\u0627\\u0635\\u060c \\u0646\\u063a\\u0637\\u064a \\u0645\\u062c\\u0645\\u0648\\u0639\\u0629 \\u0645\\u062a\\u0646\\u0648\\u0639\\u0629 \\u0645\\u0646 \\u0627\\u0644\\u0645\\u062c\\u0627\\u0644\\u0627\\u062a \\u0627\\u0644\\u0642\\u0627\\u0646\\u0648\\u0646\\u064a\\u0629 \\u0627\\u0644\\u062a\\u064a \\u062a\\u0624\\u062b\\u0631 \\u0639\\u0644\\u0649 \\u0645\\u064a\\u062f\\u0627\\u0646 \\u0627\\u0644\\u062a\\u0639\\u0644\\u064a\\u0645.<\\/p>"}',
                'icon' => NULL,
                'id' => 1,
                'image' => '/images/law_firm_main_categories/64f077c84f249.png',
                'is_active' => 1,
                'is_featured' => 1,
                'name' => '{"en":"Education Law","hi":"\\u0936\\u093f\\u0915\\u094d\\u0937\\u093e \\u0915\\u093e\\u0928\\u0942\\u0928","ar":"\\u0642\\u0627\\u0646\\u0648\\u0646 \\u0627\\u0644\\u062a\\u0639\\u0644\\u064a\\u0645"}',
                'slug' => 'shakashha-kanana-1',
                'updated_at' => '2023-10-11 17:38:30',
            ),
            1 => 
            array (
                'created_at' => '2023-11-06 15:14:44',
                'deleted_at' => '2023-11-06 15:15:38',
                'description' => '{"en":"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus ut malesuada nisl, vitae euismod libero. Maecenas accumsan nisl ut elit laoreet, in suscipit mauris sagittis. Sed vulputate, odio a consequat vulputate, orci nulla bibendum ex, eu convallis erat ex eu lacus.1","hi":"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus ut malesuada nisl, vitae euismod libero. Maecenas accumsan nisl ut elit laoreet, in suscipit mauris sagittis. Sed vulputate, odio a consequat vulputate, orci nulla bibendum ex, eu convallis erat ex eu lacus.","ar":"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus ut malesuada nisl, vitae euismod libero. Maecenas accumsan nisl ut elit laoreet, in suscipit mauris sagittis. Sed vulputate, odio a consequat vulputate, orci nulla bibendum ex, eu convallis erat ex eu lacus."}',
                'icon' => NULL,
                'id' => 2,
                'image' => '/images/law_firm_main_categories/6548bcc244f3d.png',
                'is_active' => 1,
                'is_featured' => 0,
                'name' => '{"en":"Religious Freedom and Expression","hi":"\\u0936\\u093f\\u0915\\u094d\\u0937\\u093e \\u0915\\u093e\\u0928\\u0942\\u0928","ar":"\\u0627\\u0644\\u062d\\u0631\\u064a\\u0629 \\u0627\\u0644\\u062f\\u064a\\u0646\\u064a\\u0629 \\u0648\\u0627\\u0644\\u062a\\u0639\\u0628\\u064a\\u0631"}',
                'slug' => 'religious-freedom-and-expression-2',
                'updated_at' => '2023-11-06 15:15:38',
            ),
        ));
        
        
    }
}