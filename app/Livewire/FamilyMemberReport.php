<?php

namespace App\Livewire;

use App\Exports\FamilyMemberExport;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Ward;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\FamilyMember;
use App\Models\House;

class FamilyMemberReport extends Component
{
    use WithPagination;

    public $wardFilter = '';
    public $familyFilter = '';
    public $memberFilter = '';
    public $perPage = 10;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $wards = Ward::all();
        $families = House::all();
        $members = FamilyMember::all();

        $membersQuery = FamilyMember::query();

        if ($this->wardFilter) {
            $membersQuery->whereHas('house', function ($query) {
                $query->where('ward_id', $this->wardFilter);
            });
        }

        if ($this->familyFilter) {
            $membersQuery->where('house_id', $this->familyFilter);
        }

        if ($this->memberFilter) {
            $membersQuery->where('name', 'like', '%' . $this->memberFilter . '%');
        }

        $members = $membersQuery->paginate($this->perPage);
       
        return view('livewire.family-member-report', compact('wards', 'families', 'members'));
    }

    public function export()
    {
        return Excel::download(new FamilyMemberExport($this->wardFilter, $this->familyFilter, $this->memberFilter), 'ward_family_member_report.xlsx');
    }
}

