<?php

namespace App\Exports\SuperAdmin;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CompanyPagesExport implements FromArray, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $company_pages;
    public function __construct($company_pages)
    {
        $this->company_pages = $company_pages;
    }
    public function array(): array
    {
        $data = [];
        foreach ($this->company_pages as $company_page) {
            $single = [$company_page->id, $company_page->name, $company_page->heading, $company_page->description, $company_page->is_active, date_format($company_page->created_at, 'd-m-Y')];
            $data[] = $single;
        }
        return $data;
    }
    public function headings(): array
    {
        return ["id", "name", "heading", "description", "is_active", "created_at"];
    }
}
