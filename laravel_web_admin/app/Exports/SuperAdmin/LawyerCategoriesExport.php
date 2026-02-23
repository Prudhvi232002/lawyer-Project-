<?php

namespace App\Exports\SuperAdmin;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LawyerCategoriesExport implements FromArray, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $lawyer_categories;
    public function __construct($lawyer_categories)
    {
        $this->lawyer_categories = $lawyer_categories;
    }
    public function array(): array
    {
        $data = [];
        foreach ($this->lawyer_categories as $lawyer_category) {
            $single = [$lawyer_category->id, $lawyer_category->name, $lawyer_category->description, $lawyer_category->is_active, $lawyer_category->slug, date_format($lawyer_category->created_at, 'd-m-Y')];
            $data[] = $single;
        }
        return $data;
    }
    public function headings(): array
    {
        return ["id", "name", "description", "is_active", "slug", "created_at"];
    }
}
