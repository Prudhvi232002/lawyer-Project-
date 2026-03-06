<?php

namespace App\Imports\SuperAdmin;

use App\Models\Archive;
use App\Models\BroadcastCategory;
use App\Models\EventCategory;
use App\Models\Role;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Str;

class RolesImport implements ToCollection, WithValidation, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $role = Role::create([
                'name' => $row['name'],
                'description' => $row['description'],
                'role_code' => $row['role_code'],
                'is_active' => $row['is_active'],
            ]);

            $role->save();
        }
    }
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'description' => 'required|string',

            'is_active' => 'required|numeric|in:0,1',
        ];
    }
}
