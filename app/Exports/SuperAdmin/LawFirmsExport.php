<?php

namespace App\Exports\SuperAdmin;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LawFirmsExport implements FromArray, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $law_firms;
    public function __construct($law_firms)
    {
        $this->law_firms = $law_firms;
    }
    public function array(): array
    {
        $data = [];
        foreach ($this->law_firms as $law_firm) {
            $single = [$law_firm->id, $law_firm->name, $law_firm->description, $law_firm->is_active, date_format($law_firm->created_at, 'd-m-Y')];
            $data[] = $single;
        }
        return $data;
    }
    public function headings(): array
    {
        return ["id", "name", "description", "is_active", "created_at"];
    }
}
