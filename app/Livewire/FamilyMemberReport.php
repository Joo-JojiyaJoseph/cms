<?php

namespace App\Livewire;

use App\Exports\FamilyMemberExport;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Ward;
use App\Models\House;
use App\Models\FamilyMember;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Crypt;

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

        // Fetch members with filtering
        $membersQuery = FamilyMember::query()->with(['house.ward']);

        if (!empty($this->wardFilter)) {
            $membersQuery->whereHas('house', function ($query) {
                $query->where('ward_id', $this->wardFilter);
            });
        }

        if (!empty($this->familyFilter)) {
            $membersQuery->where('house_id', $this->familyFilter);
        }

        if (!empty($this->memberFilter)) {
            $membersQuery->where('full_name', 'like', '%' . $this->memberFilter . '%');
        }

        $members = $membersQuery->paginate($this->perPage)->withQueryString();

        // Decrypt member details before passing to the view
        $members->getCollection()->transform(function ($member) {
            return (object) [
                'full_name' => Crypt::decryptString($member->full_name),
                'relationship' => Crypt::decryptString($member->relationship),
                'primary_contact' => Crypt::decryptString($member->primary_contact),
                'secondary_contact' => Crypt::decryptString($member->secondary_contact),
                'whatsapp_number' => Crypt::decryptString($member->whatsapp_number),
                'email' => Crypt::decryptString($member->email),
                'dob' => Crypt::decryptString($member->dob),
                'blood_group' => Crypt::decryptString($member->blood_group),
                'marital_status' => Crypt::decryptString($member->marital_status),
                'marriage_date' => $member->marital_status === 'Married' ? Crypt::decryptString($member->marriage_date) : null,
                'job' => Crypt::decryptString($member->job),
                'current_job_location' => Crypt::decryptString($member->current_job_location),
                'present_address' => Crypt::decryptString($member->present_address),
                'baptism_name' => Crypt::decryptString($member->baptism_name),
                'baptism_date' => Crypt::decryptString($member->baptism_date),
                'confirmation_date' => Crypt::decryptString($member->confirmation_date),
                'gender' => Crypt::decryptString($member->gender),
                'spouse' => Crypt::decryptString($member->spouse),
                'image' => $member->image, // No need to decrypt file names
                'father' => Crypt::decryptString($member->father),
                'mother' => Crypt::decryptString($member->mother),
                'family' => $member->house->house_name ?? 'N/A',
                'ward' => $member->house->ward->name ?? 'N/A',
            ];
        });

        return view('livewire.family-member-report', compact('wards', 'families', 'members'));
    }

    public function export()
    {
        return Excel::download(new FamilyMemberExport($this->wardFilter, $this->familyFilter, $this->memberFilter), 'ward_family_member_report.xlsx');
    }
}
