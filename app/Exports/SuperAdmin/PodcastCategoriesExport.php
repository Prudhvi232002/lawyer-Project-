<?php

namespace App\Exports\SuperAdmin;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PodcastCategoriesExport implements FromArray, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $podcast_categories;
    public function __construct($podcast_categories)
    {
        $this->podcast_categories = $podcast_categories;
    }
    public function array(): array
    {
        $data = [];
        foreach ($this->podcast_categories as $podcast_category) {
            $single = [$podcast_category->id, $podcast_category->name, $podcast_category->description, $podcast_category->is_active, $podcast_category->slug, date_format($podcast_category->created_at, 'd-m-Y')];
            $data[] = $single;
        }
        return $data;
    }
    public function headings(): array
    {
        return ["id", "name", "description", "is_active", "slug", "created_at"];
    }
}
