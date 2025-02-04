<?php

namespace App\Exports;

use App\Models\FamilyMember;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class FamilyMemberExport implements FromCollection, WithHeadings
{
    protected $wardFilter;
    protected $familyFilter;
    protected $memberFilter;

    public function __construct($wardFilter, $familyFilter, $memberFilter)
    {
        $this->wardFilter = $wardFilter;
        $this->familyFilter = $familyFilter;
        $this->memberFilter = $memberFilter;
    }

    public function collection()
    {
        $query = FamilyMember::query();

        if ($this->wardFilter) {
            $query->whereHas('family', function ($query) {
                $query->where('ward_id', $this->wardFilter);
            });
        }

        if ($this->familyFilter) {
            $query->where('family_id', $this->familyFilter);
        }

        if ($this->memberFilter) {
            $query->where('name', 'like', '%' . $this->memberFilter . '%');
        }

        return $query->get(['name', 'family_id', 'ward_id', 'contact']);
    }

    public function headings(): array
    {
        return ['Member Name', 'Family ID', 'Ward ID', 'Contact'];
    }
}

