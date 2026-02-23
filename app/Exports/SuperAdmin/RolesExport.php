<?php

namespace App\Exports\SuperAdmin;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RolesExport implements FromArray, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $roles;
    public function __construct($roles)
    {
        $this->roles = $roles;
    }
    public function array(): array
    {
        $data = [];
        foreach ($this->roles as $role) {
            $single = [$role->id, $role->name, $role->description,$role->role_code, $role->is_active, date_format($role->created_at, 'd-m-Y')];
            $data[] = $single;
        }
        return $data;
    }
    public function headings(): array
    {
        return ["id", "name", "description","role_code", "is_active", "created_at"];
    }
}
