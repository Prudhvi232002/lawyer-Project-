<?php

namespace App\Imports\SuperAdmin;

use App\Models\Broadcast;
use App\Models\BroadcastCategory;
use App\Models\EventCategory;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Str;

class BroadcastsImport implements ToCollection, WithValidation, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $broadcast = Broadcast::create([
                'name' => $row['name'],
                'description' => $row['description'],
                'is_active' => $row['is_active'],
                'image' => $row['image'] ?? null,
            ]);
            $broadcast->slug = Str::slug($row['name'] . ' ' . $broadcast->id);
            $broadcast->save();
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
