<?php

namespace App\Exports\SuperAdmin;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ContactsExport implements FromArray, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $contacts;
    public function __construct($contacts)
    {
        $this->contacts = $contacts;
    }
    public function array(): array
    {
        $data = [];
        foreach ($this->contacts as $contact) {
            $single = [$contact->id, $contact->name, $contact->email, $contact->phone, $contact->message, date_format($contact->created_at, 'd-m-Y')];
            $data[] = $single;
        }
        return $data;
    }
    public function headings(): array
    {
        return ["id", "name", "email", "phone", "message", "created_at"];
    }
}
