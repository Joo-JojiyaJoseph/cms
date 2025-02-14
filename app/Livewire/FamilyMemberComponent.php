<?php

namespace App\Livewire;

use App\Models\FamilyMember;
use Livewire\Component;
use Livewire\WithFileUploads;

class FamilyMemberComponent extends Component
{
    use WithFileUploads;
    public $house_id, $family_members,$image, $newImage;
    public $family_member_id, $full_name, $primary_contact, $secondary_contact, $whatsapp_number,
     $email, $dob, $blood_group, $job, $current_job_location,
     $permanent_address, $present_address, $baptism_name, $baptism_date,$confirmation_date,$relationship, $member_of_parish_since,$gender;
    public $isOpen = false;
    public $marital_status="";
     public $marriage_date;
     public $same_as_permanent = false;
     public $member_since;
     public $spouse="";


    protected $rules = [
        'full_name' => 'required',
        'primary_contact' => 'required',
        'dob' => 'required',
        'marital_status' => 'required',
    ];

    public function mount($house_id)
    {
        $this->house_id = $house_id;
        $this->loadFamilyMembers();
    }

    public function loadFamilyMembers()
    {

        $this->family_members = FamilyMember::where('house_id', $this->house_id)->get();
    }

    public function openModal($id = null)
    {
        // $this->resetInputFields();
        // $this->isOpen = true;

        if ($id) {
            $member = FamilyMember::find($id);
            $this->family_member_id = $member->id;
            $this->marital_status = $member->marital_status;
            $this->marriage_date = $member->marriage_date; // Set the marriage date if available
        } else {
            $this->resetInputFields();
        }

        $this->isOpen = true;
    }

//     public function updatedMaritalStatus($value)
// {
//     if ($value === 'Married') {
//         $this->marital_status = "Married"; // Optional: Pre-fill today’s date
//     } else {
//         $this->marital_status =  $this->marital_status;
//     }
// }

    public function closeModal()
    {
        // $this->resetInputFields();
        $this->isOpen = false;
    }

    public function resetInputFields()
    {
        $this->family_member_id = null;
        $this->full_name = '';
        $this->primary_contact = '';
        $this->secondary_contact = '';
        $this->whatsapp_number = '';
        $this->email = '';
        $this->blood_group = '';
        $this->marital_status = '';
        $this->job = '';
        $this->current_job_location = '';
        $this->permanent_address = '';
        $this->present_address = '';
        $this->baptism_name = '';
        $this->relationship = '';
        $this->spouse = '';
        $this->image = '';
        $this->newImage = '';
    }
   

    public function saveFamilyMember()
    {
        $this->validate();

        if ($this->newImage) {
            $imageName = $this->newImage->store('wards', 'public');
        } else {
            $imageName = $this->image;
        }

        FamilyMember::updateOrCreate(
            ['id' => $this->family_member_id],
            [
                'house_id' => $this->house_id, // Ensure house_id is set
                'full_name' => $this->full_name,
                'relationship' => $this->relationship,
                'primary_contact' => $this->primary_contact,
                'secondary_contact' => $this->secondary_contact,
                'whatsapp_number' => $this->secondary_contact,
                'email' => $this->email,
                'dob' => $this->dob?: null,
                'blood_group' => $this->blood_group,
                'marital_status' => $this->marital_status,
                'marriage_date' => $this->marital_status === 'Married' ? $this->marriage_date : null,
                'job' => $this->job,
                'current_job_location' => $this->current_job_location,
                'permanent_address' => $this->permanent_address,
                'present_address' => $this->present_address,
                'baptism_name' => $this->baptism_name,
                'baptism_date' => $this->baptism_date?: null,
                'confirmation_date' => $this->confirmation_date?: null,
                'member_of_parish_since' => $this->member_of_parish_since?: null,
                'gender' => $this->gender,
                'spouse'=>$this->spouse,
                'image' => $imageName,
            ]
        );

        session()->flash('message', $this->family_member_id ? 'Family Member Updated Successfully!' : 'Family Member Added Successfully!');
        $this->closeModal();
        $this->loadFamilyMembers(); // Reload members after update
    }

    public function editFamilyMember($id)
    {
        $member = FamilyMember::findOrFail($id);
        $this->family_member_id = $id;
        $this->full_name = $member->full_name;
        $this->relationship = $member->relationship;
        $this->primary_contact = $member->primary_contact;
        $this->secondary_contact = $member->secondary_contact;
        $this->whatsapp_number = $member->whatsapp_number;
        $this->email = $member->email;
        $this->dob = $member->dob;
        $this->blood_group = $member->blood_group;
        $this->marital_status = $member->marital_status;
        $this->marriage_date = $member->marriage_date;
        $this->job = $member->job;
        $this->current_job_location = $member->current_job_location;
        $this->permanent_address = $member->permanent_address;
        $this->present_address = $member->present_address;
        $this->baptism_name = $member->baptism_name;
        $this->member_of_parish_since = $member->member_of_parish_since;
        $this->baptism_date =  $member->baptism_date;
        $this->confirmation_date =  $member->confirmation_date;
        $this->gender =  $member->gender;
        $this->spouse= $member->spouse;

        $this->isOpen = true;
    }

    public function deleteFamilyMember($id)
    {
        FamilyMember::find($id)->delete();
        session()->flash('message', 'Family Member Deleted Successfully!');
        $this->loadFamilyMembers();
    }

    public function render()
    {
        return view('livewire.family-member-component');
    }}
