<?php

namespace App\Exports\SuperAdmin;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LawFirmMainCategoriesExport implements FromArray, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $lawfirm_main_categories;
    public function __construct($lawfirm_main_categories)
    {
        $this->lawfirm_main_categories = $lawfirm_main_categories;
    }
    public function array(): array
    {
        $data = [];
        foreach ($this->lawfirm_main_categories as $lawfirm_main_categories) {
            $single = [$lawfirm_main_categories->id, $lawfirm_main_categories->name, $lawfirm_main_categories->description,$lawfirm_main_categories->icon,$lawfirm_main_categories->image, $lawfirm_main_categories->is_active, $lawfirm_main_categories->slug, date_format($lawfirm_main_categories->created_at, 'd-m-Y')];
            $data[] = $single;
        }
        return $data;
    }
    public function headings(): array
    {
        return ["id", "name", "description","icon","image", "is_active", "slug", "created_at"];
    }
}
