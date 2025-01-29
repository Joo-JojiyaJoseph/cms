<?php

namespace App\Livewire;

use App\Models\FamilyMember;
use Livewire\Component;

class FamilyMemberComponent extends Component
{
    public $family_members, $isOpen = false, $family_member_id;
    public $full_name, $primary_contact, $secondary_contact, $whatsapp_number, $email, $dob, $blood_group;
    public $marital_status, $marriage_date, $job, $current_job_location, $permanent_address, $present_address;
    public $same_as_permanent = false, $baptism_name;

    public function render()
    {
        $this->family_members = FamilyMember::all();
        return view('livewire.family-member-component');
    }

    public function openModal()
    {
        $this->resetInput();
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    public function editFamilyMember($id)
    {
        $member = FamilyMember::findOrFail($id);
        $this->family_member_id = $id;
        $this->fill($member->toArray());
        $this->isOpen = true;
    }

    public function saveFamilyMember()
    {
        $this->validate([
            'full_name' => 'required|string|max:255',
            'primary_contact' => 'required|string|max:15',
            'dob' => 'required|date',
            'blood_group' => 'required|string|max:5',
            'marital_status' => 'required|string',
            'job' => 'required|string|max:255',
            'current_job_location' => 'required|string|max:255',
            'permanent_address' => 'required|string|max:500',
        ]);

        if ($this->same_as_permanent) {
            $this->present_address = $this->permanent_address;
        }

        FamilyMember::updateOrCreate(
            ['id' => $this->family_member_id],
            [
                'full_name' => $this->full_name,
                'primary_contact' => $this->primary_contact,
                'secondary_contact' => $this->secondary_contact,
                'whatsapp_number' => $this->whatsapp_number,
                'email' => $this->email,
                'dob' => $this->dob,
                'blood_group' => $this->blood_group,
                'marital_status' => $this->marital_status,
                'marriage_date' => $this->marital_status === 'Married' ? $this->marriage_date : null,
                'job' => $this->job,
                'current_job_location' => $this->current_job_location,
                'permanent_address' => $this->permanent_address,
                'present_address' => $this->present_address,
                'baptism_name' => $this->baptism_name,
            ]
        );

        session()->flash('message', $this->family_member_id ? 'Family Member Updated' : 'Family Member Added');

        $this->closeModal();
    }

    public function deleteFamilyMember($id)
    {
        FamilyMember::find($id)->delete();
        session()->flash('message', 'Family Member Deleted');
    }

    private function resetInput()
    {
        $this->family_member_id = null;
        $this->full_name = $this->primary_contact = $this->secondary_contact = $this->whatsapp_number = $this->email = null;
        $this->dob = $this->blood_group = $this->marital_status = $this->marriage_date = null;
        $this->job = $this->current_job_location = $this->permanent_address = $this->present_address = null;
        $this->same_as_permanent = false;
        $this->baptism_name = null;
    }    // public function render()
    // {
    //     return view('livewire.family-member-component');
    // }

}
