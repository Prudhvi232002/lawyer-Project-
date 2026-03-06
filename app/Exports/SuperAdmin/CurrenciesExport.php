<?php

namespace App\Exports\SuperAdmin;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CurrenciesExport implements FromArray, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $currencies;
    public function __construct($currencies)
    {
        $this->currencies = $currencies;
    }
    public function array(): array
    {
        $data = [];
        foreach ($this->currencies as $currency) {
            $single = [$currency->id, $currency->name, $currency->code, $currency->symbol, $currency->direction, date_format($currency->created_at, 'd-m-Y')];
            $data[] = $single;
        }
        return $data;
    }
    public function headings(): array
    {
        return ["id", "name", "code", "symbol", "direction", "created_at"];
    }
}
