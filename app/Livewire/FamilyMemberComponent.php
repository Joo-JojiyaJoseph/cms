<?php

namespace App\Livewire;

use App\Models\FamilyMember;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Crypt;

class FamilyMemberComponent extends Component
{
    use WithFileUploads;
    public $house_id, $family_members,$image, $newImage;
    public $family_member_id, $full_name, $primary_contact, $secondary_contact, $whatsapp_number,
     $email, $dob, $blood_group, $job, $current_job_location,$father,$mother,
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
        $this->family_members = FamilyMember::where('house_id', $this->house_id)->get()->map(function ($member) {
            return (object) [
                'id' => $member->id,
                'full_name' => $member->full_name ? Crypt::decryptString($member->full_name) : null,
                'relationship' => $member->relationship ? Crypt::decryptString($member->relationship) : null,
                'primary_contact' => $member->primary_contact ? Crypt::decryptString($member->primary_contact) : null,
                'secondary_contact' => $member->secondary_contact ? Crypt::decryptString($member->secondary_contact) : null,
                'email' => $member->email ? Crypt::decryptString($member->email) : null,
                'dob' => $member->dob,
                'blood_group' => $member->blood_group ? Crypt::decryptString($member->blood_group) : null,
                'marital_status' => $member->marital_status ? Crypt::decryptString($member->marital_status) : null,
                'marriage_date' => $member->marital_status === 'Married' ? $member->marriage_date : null,
                'job' => $member->job ? Crypt::decryptString($member->job) : null,
                'current_job_location' => $member->current_job_location ? Crypt::decryptString($member->current_job_location) : null,
                'present_address' => $member->present_address ? Crypt::decryptString($member->present_address) : null,
                'baptism_name' => $member->baptism_name ? Crypt::decryptString($member->baptism_name) : null,
                'baptism_date' => $member->baptism_date,
                'confirmation_date' => $member->confirmation_date,
                'gender' => $member->gender ? Crypt::decryptString($member->gender) : null,
                'spouse' => $member->spouse ? Crypt::decryptString($member->spouse) : null,
                'image' => $member->image, // No need to decrypt file names
                'father' => $member->father ? Crypt::decryptString($member->father) : null,
                'mother' => $member->mother ? Crypt::decryptString($member->mother) : null,
            ];
        });

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
                'house_id' => $this->house_id,
                'full_name' => Crypt::encryptString($this->full_name),
                'relationship' => Crypt::encryptString($this->relationship),
                'primary_contact' => Crypt::encryptString($this->primary_contact),
                'secondary_contact' => Crypt::encryptString($this->secondary_contact),
                'email' => Crypt::encryptString($this->email),
                'dob' => $this->dob ?? null,
                'blood_group' => Crypt::encryptString($this->blood_group),
                'marital_status' => Crypt::encryptString($this->marital_status),
                'marriage_date' => $this->marriage_date ? $this->marriage_date : null,
                'job' => Crypt::encryptString($this->job),
                'current_job_location' => Crypt::encryptString($this->current_job_location),
                'present_address' => Crypt::encryptString($this->present_address),
                'baptism_name' => Crypt::encryptString($this->baptism_name),
                'baptism_date' => $this->baptism_date ?? null,
                'confirmation_date' => $this->confirmation_date ?? null,
                'gender' => Crypt::encryptString($this->gender),
                'spouse' => Crypt::encryptString($this->spouse),
                'image' => $imageName, // If image is available
                'father' => Crypt::encryptString($this->father),
                'mother' => Crypt::encryptString($this->mother),
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

        // Wrap decryption in try-catch to handle invalid payloads
        $this->full_name = $this->safeDecrypt($member->full_name);
        $this->relationship = $this->safeDecrypt($member->relationship);
        $this->primary_contact = $this->safeDecrypt($member->primary_contact);
        $this->secondary_contact = $this->safeDecrypt($member->secondary_contact);
        $this->email = $this->safeDecrypt($member->email);
        $this->dob = $member->dob;
        $this->blood_group = $this->safeDecrypt($member->blood_group);
        $this->marital_status = $this->safeDecrypt($member->marital_status);
        $this->marriage_date = $member->marriage_date;
        $this->job = $this->safeDecrypt($member->job);
        $this->current_job_location = $this->safeDecrypt($member->current_job_location);
        $this->present_address = $this->safeDecrypt($member->present_address);
        $this->baptism_name = $this->safeDecrypt($member->baptism_name);
        $this->baptism_date = $member->baptism_date; // No decryption needed
        $this->confirmation_date = $member->confirmation_date; // No decryption needed
        $this->gender = $this->safeDecrypt($member->gender);
        $this->spouse = $this->safeDecrypt($member->spouse);
        $this->father = $this->safeDecrypt($member->father);
        $this->mother = $this->safeDecrypt($member->mother);

        $this->isOpen = true;
    }

    /**
     * Attempt to decrypt a value safely and return null if decryption fails.
     *
     * @param string|null $value
     * @return string|null
     */
    private function safeDecrypt($value)
    {
        try {
            return $value ? Crypt::decryptString($value) : null;
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            // Log the error or handle it as needed
            \Log::error("Decryption failed for value: $value", ['exception' => $e]);
            return null; // Return null or a default value
        }
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
