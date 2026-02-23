<?php

namespace App\Exports\SuperAdmin;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ArchivesExport implements FromArray, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $archives;
    public function __construct($archives)
    {
        $this->archives = $archives;
    }
    public function array(): array
    {
        $data = [];
        foreach ($this->archives as $archive) {
            $single = [$archive->id, $archive->name, $archive->description, $archive->is_active, $archive->slug, date_format($archive->created_at, 'd-m-Y')];
            $data[] = $single;
        }
        return $data;
    }
    public function headings(): array
    {
        return ["id", "name", "description", "is_active", "slug", "created_at"];
    }
}
