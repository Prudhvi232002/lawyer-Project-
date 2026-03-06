<?php

namespace App\Exports\SuperAdmin;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LawyersExport implements FromArray, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $lawyers;
    public function __construct($lawyers)
    {
        $this->lawyers = $lawyers;
    }
    public function array(): array
    {
        $data = [];
        foreach ($this->lawyers as $lawyer) {
            $single = [$lawyer->id, $lawyer->name, $lawyer->description, $lawyer->is_active, date_format($lawyer->created_at, 'd-m-Y')];
            $data[] = $single;
        }
        return $data;
    }
    public function headings(): array
    {
        return ["id", "name", "description", "is_active", "created_at"];
    }
}
