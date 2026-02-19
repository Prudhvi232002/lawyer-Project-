<?php

namespace App\Exports\SuperAdmin;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LawFirmCategoriesExport implements FromArray, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $law_firm_categories;
    public function __construct($law_firm_categories)
    {
        $this->law_firm_categories = $law_firm_categories;
    }
    public function array(): array
    {
        $data = [];
        foreach ($this->law_firm_categories as $law_firm_category) {
            $single = [$law_firm_category->id, $law_firm_category->name, $law_firm_category->description, $law_firm_category->is_active, $law_firm_category->slug, date_format($law_firm_category->created_at, 'd-m-Y')];
            $data[] = $single;
        }
        return $data;
    }
    public function headings(): array
    {
        return ["id", "name", "description", "is_active", "slug", "created_at"];
    }
}
