<?php

namespace App\Imports\SuperAdmin;


use App\Models\Contact;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Str;

class ContactsImport implements ToCollection, WithValidation, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $Contact = Contact::create([
                'name' => $row['name'],
                'email' => $row['email'],
                'phone' => $row['phone'],
                'description' => $row['description'],
                'is_active' => $row['is_active'],
                'image' => $row['image'] ?? null,
            ]);
            $Contact->slug = Str::slug($row['name'] . ' ' . $Contact->id);
            $Contact->save();
        }
    }
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'description' => 'required|string',
            'image' => 'nullable|string',
            'is_active' => 'required|numeric|in:0,1',
        ];
    }
}
