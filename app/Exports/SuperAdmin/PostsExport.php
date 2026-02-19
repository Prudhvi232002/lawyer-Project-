<?php

namespace App\Exports\SuperAdmin;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PostsExport implements FromArray, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $posts;
    public function __construct($posts)
    {
        $this->posts = $posts;
    }
    public function array(): array
    {
        $data = [];
        foreach ($this->posts as $blog) {
            $single = [$blog->id, $blog->name, $blog->description, $blog->is_active, $blog->slug, date_format($blog->created_at, 'd-m-Y')];
            $data[] = $single;
        }
        return $data;
    }
    public function headings(): array
    {
        return ["id", "name", "description", "is_active", "slug", "created_at"];
    }
}
