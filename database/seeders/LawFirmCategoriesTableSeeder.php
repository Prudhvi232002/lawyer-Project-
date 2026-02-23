<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LawFirmCategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('law_firm_categories')->delete();
        
        \DB::table('law_firm_categories')->insert(array (
            0 => 
            array (
                'created_at' => '2023-08-31 14:29:48',
                'deleted_at' => NULL,
                'description' => '{"en":"<p>At EduLegis, we not only comprehend the legal intricacies but also understand the profound impact of our work on the future of learning. Our mission is to ensure a fair, equitable, and transparent educational environment for all stakeholders. Backed by years of experience and a deep passion for education, EduLegis Associates stands as a beacon of legal support and guidance within the education industry.<\\/p>","hi":"<p>\\u090f\\u0921\\u094d\\u092f\\u0942\\u0932\\u0947\\u0917\\u093f\\u0938 \\u092e\\u0947\\u0902, \\u0939\\u092e \\u0915\\u0947\\u0935\\u0932 \\u0915\\u093e\\u0928\\u0942\\u0928\\u0940 \\u091c\\u091f\\u093f\\u0932\\u0924\\u093e\\u0913\\u0902 \\u0915\\u094b \\u0938\\u092e\\u091d\\u0924\\u0947 \\u0939\\u0940 \\u0928\\u0939\\u0940\\u0902 \\u0939\\u0948\\u0902 \\u092c\\u0932\\u094d\\u0915\\u093f \\u0939\\u092e\\u093e\\u0930\\u0947 \\u0915\\u093e\\u092e \\u0915\\u0947 \\u0917\\u0939\\u0930\\u0947 \\u092a\\u094d\\u0930\\u092d\\u093e\\u0935 \\u0915\\u094b \\u0936\\u093f\\u0915\\u094d\\u0937\\u093e \\u0915\\u0947 \\u092d\\u0935\\u093f\\u0937\\u094d\\u092f \\u092a\\u0930 \\u0938\\u092e\\u091d\\u0924\\u0947 \\u0939\\u0948\\u0902\\u0964 \\u0939\\u092e\\u093e\\u0930\\u093e \\u0909\\u0926\\u094d\\u0926\\u0947\\u0936\\u094d\\u092f \\u0938\\u092d\\u0940 \\u0939\\u093f\\u0924\\u0927\\u093e\\u0930\\u0915\\u094b\\u0902 \\u0915\\u0947 \\u0932\\u093f\\u090f \\u090f\\u0915 \\u0928\\u093f\\u0937\\u094d\\u092a\\u0915\\u094d\\u0937, \\u0938\\u092e\\u093e\\u0928 \\u0914\\u0930 \\u092a\\u093e\\u0930\\u0926\\u0930\\u094d\\u0936\\u0940 \\u0936\\u0948\\u0915\\u094d\\u0937\\u093f\\u0915 \\u0935\\u093e\\u0924\\u093e\\u0935\\u0930\\u0923 \\u0938\\u0941\\u0928\\u093f\\u0936\\u094d\\u091a\\u093f\\u0924 \\u0915\\u0930\\u0928\\u093e \\u0939\\u0948\\u0964 \\u0936\\u093f\\u0915\\u094d\\u0937\\u093e \\u092e\\u0947\\u0902 \\u0935\\u093f\\u0927\\u093f\\u0915 \\u0938\\u092e\\u0930\\u094d\\u0925\\u0928 \\u0914\\u0930 \\u092e\\u093e\\u0930\\u094d\\u0917\\u0926\\u0930\\u094d\\u0936\\u0928 \\u0915\\u0947 \\u090f\\u0915 \\u092c\\u0940\\u091c\\u0928 \\u0938\\u0947 \\u0938\\u091c\\u0940\\u0935 \\u0915\\u093f\\u092f\\u093e \\u0917\\u092f\\u093e \\u0939\\u0948, \\u091c\\u093f\\u0938\\u0947 \\u0936\\u093f\\u0915\\u094d\\u0937\\u093e \\u0915\\u0947 \\u0909\\u0926\\u094d\\u092f\\u094b\\u0917 \\u092e\\u0947\\u0902 \\u0915\\u093e\\u0928\\u0942\\u0928\\u0940 \\u0938\\u092e\\u0930\\u094d\\u0925\\u0928 \\u0914\\u0930 \\u092e\\u093e\\u0930\\u094d\\u0917\\u0926\\u0930\\u094d\\u0936\\u0928 \\u0915\\u0940 \\u0930\\u094c\\u0936\\u0928\\u0940 \\u092e\\u0947\\u0902 \\u0916\\u0921\\u093c\\u093e \\u0915\\u093f\\u092f\\u093e \\u091c\\u093e\\u0924\\u093e \\u0939\\u0948\\u0964<\\/p>","ar":"<p>\\u0641\\u064a \\u0625\\u064a\\u062f\\u0648 \\u0644\\u064a\\u062c\\u0633\\u060c \\u0646\\u062d\\u0646 \\u0644\\u0627 \\u0646\\u0641\\u0647\\u0645 \\u0641\\u0642\\u0637 \\u0627\\u0644\\u062a\\u0641\\u0627\\u0635\\u064a\\u0644 \\u0627\\u0644\\u0642\\u0627\\u0646\\u0648\\u0646\\u064a\\u0629 \\u0628\\u0644 \\u0646\\u062f\\u0631\\u0643 \\u0623\\u064a\\u0636\\u0627 \\u0627\\u0644\\u0623\\u062b\\u0631 \\u0627\\u0644\\u0639\\u0645\\u064a\\u0642 \\u0644\\u0639\\u0645\\u0644\\u0646\\u0627 \\u0639\\u0644\\u0649 \\u0645\\u0633\\u062a\\u0642\\u0628\\u0644 \\u0627\\u0644\\u062a\\u0639\\u0644\\u0645. \\u0645\\u0647\\u0645\\u062a\\u0646\\u0627 \\u0647\\u064a \\u0636\\u0645\\u0627\\u0646 \\u0628\\u064a\\u0626\\u0629 \\u062a\\u0639\\u0644\\u064a\\u0645\\u064a\\u0629 \\u0639\\u0627\\u062f\\u0644\\u0629 \\u0648\\u0645\\u0646\\u0635\\u0641\\u0629 \\u0648\\u0634\\u0641\\u0627\\u0641\\u0629 \\u0644\\u062c\\u0645\\u064a\\u0639 \\u0627\\u0644\\u0641\\u0627\\u0639\\u0644\\u064a\\u0646. \\u0645\\u062f\\u0639\\u0648\\u0645\\u0648\\u0646 \\u0628\\u0633\\u0646\\u0648\\u0627\\u062a \\u0645\\u0646 \\u0627\\u0644\\u062e\\u0628\\u0631\\u0629 \\u0648\\u0634\\u063a\\u0641 \\u0639\\u0645\\u064a\\u0642 \\u0628\\u0627\\u0644\\u062a\\u0639\\u0644\\u064a\\u0645\\u060c \\u062a\\u0642\\u0641 \\u0645\\u0643\\u062a\\u0628 \\u0625\\u064a\\u062f\\u0648 \\u0644\\u064a\\u062c\\u0633 \\u0643\\u0645\\u0635\\u0628\\u0627\\u062d \\u062f\\u0644\\u064a\\u0644 \\u0642\\u0627\\u0646\\u0648\\u0646\\u064a \\u0641\\u064a \\u0635\\u0646\\u0627\\u0639\\u0629 \\u0627\\u0644\\u062a\\u0639\\u0644\\u064a\\u0645.<\\/p>"}',
                'icon' => NULL,
                'id' => 1,
                'image' => '/images/law_firm_categories/64f079ac3f2e8.png',
                'is_active' => 1,
                'is_featured' => 0,
                'name' => '{"en":"Education Law","hi":"\\u0936\\u093f\\u0915\\u094d\\u0937\\u093e \\u0915\\u093e\\u0928\\u0942\\u0928","ar":"\\u0642\\u0627\\u0646\\u0648\\u0646 \\u0627\\u0644\\u062a\\u0639\\u0644\\u064a\\u0645"}',
                'parent_category_id' => 1,
                'slug' => 'shakashha-kanana-1',
                'updated_at' => '2023-10-11 17:40:45',
            ),
            1 => 
            array (
                'created_at' => '2023-11-06 15:19:30',
                'deleted_at' => '2023-11-06 15:20:06',
                'description' => '{"en":"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus ut malesuada nisl, vitae euismod libero. Maecenas accumsan nisl ut elit laoreet, in suscipit mauris sagittis. Sed vulputate, odio a consequat vulputate, orci nulla bibendum ex, eu convallis erat ex eu lacus.1","hi":"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus ut malesuada nisl, vitae euismod libero. Maecenas accumsan nisl ut elit laoreet, in suscipit mauris sagittis. Sed vulputate, odio a consequat vulputate, orci nulla bibendum ex, eu convallis erat ex eu lacus.","ar":"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus ut malesuada nisl, vitae euismod libero. Maecenas accumsan nisl ut elit laoreet, in suscipit mauris sagittis. Sed vulputate, odio a consequat vulputate, orci nulla bibendum ex, eu convallis erat ex eu lacus."}',
                'icon' => NULL,
                'id' => 2,
                'image' => '/images/law_firm_categories/6548bdb200a13.png',
                'is_active' => 1,
                'is_featured' => 0,
                'name' => '{"en":"Religious Freedom and Expression","hi":"\\u0927\\u093e\\u0930\\u094d\\u092e\\u093f\\u0915 \\u0938\\u094d\\u0935\\u0924\\u0902\\u0924\\u094d\\u0930\\u0924\\u093e \\u0914\\u0930 \\u0905\\u092d\\u093f\\u0935\\u094d\\u092f\\u0915\\u094d\\u0924\\u093f","ar":"\\u0627\\u0644\\u062d\\u0631\\u064a\\u0629 \\u0627\\u0644\\u062f\\u064a\\u0646\\u064a\\u0629 \\u0648\\u0627\\u0644\\u062a\\u0639\\u0628\\u064a\\u0631"}',
                'parent_category_id' => 1,
                'slug' => 'religious-freedom-and-expression-2',
                'updated_at' => '2023-11-06 15:20:06',
            ),
        ));
        
        
    }
}