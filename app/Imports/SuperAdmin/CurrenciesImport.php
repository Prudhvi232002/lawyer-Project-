<?php

namespace App\Imports\SuperAdmin;


use App\Models\Contact;
use App\Models\Currency;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Str;

class CurrenciesImport implements ToCollection, WithValidation, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $currency = Currency::create([
                'name' => $row['name'],
                'code' => $row['code'],
                'symbol' => $row['symbol'],
                'direction' => $row['direction'],
                'is_active' => $row['is_active'],
                'image' => $row['image'] ?? null,
            ]);

            $currency->save();
        }
    }
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'code' => 'required|string',
            'symbol' => 'nullable|string',
            'is_active' => 'required|numeric|in:0,1',
        ];
    }
}
