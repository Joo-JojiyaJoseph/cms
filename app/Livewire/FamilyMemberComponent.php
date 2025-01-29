<?php

namespace App\Livewire;

use App\Models\FamilyMember;
use Livewire\Component;

class FamilyMemberComponent extends Component
{
    // public function render()
    // {
    //     return view('livewire.family-member-component');
    // }


    public $house_id, $family_members, $family_member_id, $name, $age, $relation;
    public $isOpen = false;

    public function mount($house_id)
    {
        $this->house_id = $house_id;
    }

    public function render()
    {
        $this->family_members = FamilyMember::where('house_id', $this->house_id)->get();
        return view('livewire.family-member-component');
    }

    public function openModal()
    {
        $this->resetFields();
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    private function resetFields()
    {
        $this->family_member_id = '';
        $this->name = '';
        $this->age = '';
        $this->relation = '';
    }

    public function saveFamilyMember()
    {
        $validatedData = $this->validate([
            'name' => 'required|string',
            'age' => 'required|integer|min:0',
            'relation' => 'required|string',
        ]);

        FamilyMember::updateOrCreate(
            ['id' => $this->family_member_id],
            ['house_id' => $this->house_id, 'name' => $this->name, 'age' => $this->age, 'relation' => $this->relation]
        );

        session()->flash('message', $this->family_member_id ? 'Family Member updated successfully!' : 'Family Member added successfully!');
        $this->closeModal();
    }

    public function editFamilyMember($id)
    {
        $familyMember = FamilyMember::findOrFail($id);
        $this->family_member_id = $familyMember->id;
        $this->name = $familyMember->name;
        $this->age = $familyMember->age;
        $this->relation = $familyMember->relation;
        $this->isOpen = true;
    }

    public function deleteFamilyMember($id)
    {
        FamilyMember::findOrFail($id)->delete();
        session()->flash('message', 'Family Member deleted successfully!');
    }
}
