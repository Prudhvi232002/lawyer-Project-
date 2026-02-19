<?php

namespace App\Exports\SuperAdmin;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LawyerMainCategoriesExport implements FromArray, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $lawyer_main_categories;
    public function __construct($lawyer_main_categories)
    {
        $this->lawyer_main_categories = $lawyer_main_categories;
    }
    public function array(): array
    {
        $data = [];
        foreach ($this->lawyer_main_categories as $lawyer_main_categories) {
            $single = [$lawyer_main_categories->id, $lawyer_main_categories->name, $lawyer_main_categories->description,$lawyer_main_categories->icon,$lawyer_main_categories->image, $lawyer_main_categories->is_active, $lawyer_main_categories->slug, date_format($lawyer_main_categories->created_at, 'd-m-Y')];
            $data[] = $single;
        }
        return $data;
    }
    public function headings(): array
    {
        return ["id", "name", "description","icon","image", "is_active", "slug", "created_at"];
    }
}
