<?php

namespace App\Imports\SuperAdmin;

use App\Models\LawyerCategory;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Str;

class LawyerCategoriesImport implements ToCollection, WithValidation, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $lawyer_category = LawyerCategory::create([
                'name' => $row['name'],
                'description' => $row['description'],
                'is_active' => $row['is_active'],
                'image' => $row['image'] ?? null,
                'parent_category_id' => $row['parent_category_id'] ?? null,

            ]);
            $lawyer_category->slug = Str::slug($row['name'] . ' ' . $lawyer_category->id);
            $lawyer_category->save();
        }
    }
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'description' => 'required|string',
            'image' => 'nullable|string',
            'is_active' => 'required|numeric|in:0,1',
            'parent_category_id' => 'required|numeric',

        ];
    }
}
