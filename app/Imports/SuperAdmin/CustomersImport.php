<?php

namespace App\Imports\SuperAdmin;

use App\Models\Customer;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Str;

class CustomersImport implements ToCollection, WithValidation, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $customer = Customer::create([
                'user_name' => $row['user_name'],
                'first_name' => $row['first_name'],
                'last_name' => $row['last_name'],
                'description' => $row['description'],
                "address_line_1" => $row['address_line_1'],
                'zip_code' => $row['zip_code'],
                'is_active' => $row['is_active'],
                'image' => $row['image'] ?? null,
            ]);
        }
    }
    public function rules(): array
    {
        return [
            'first_name' => 'required|string',
            'description' => 'nullable|string',
            'image' => 'nullable|string',
            'user_name' => 'required|alpha_dash|unique:customers,user_name',
            'is_active' => 'required|numeric|in:0,1',
        ];
    }
}
