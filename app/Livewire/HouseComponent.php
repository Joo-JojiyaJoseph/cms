<?php

namespace App\Livewire;

use App\Models\House;
use Livewire\Component;

class HouseComponent extends Component
{

    public $ward_id, $houses, $house_id, $house_name, $number_of_members;
    public $isOpen = false;

    public function mount($ward_id)
    {
        $this->ward_id = $ward_id;
    }

    public function render()
    {
        $this->houses = House::where('ward_id', $this->ward_id)->get();
        return view('livewire.house-component');
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
        $this->house_id = '';
        $this->house_name = '';
        $this->number_of_members = '';
    }

    public function saveHouse()
    {
        $validatedData = $this->validate([
            'house_name' => 'required|string',
            'number_of_members' => 'required|integer|min:1',
        ]);

        House::updateOrCreate(
            ['id' => $this->house_id],
            ['ward_id' => $this->ward_id, 'house_name' => $this->house_name, 'number_of_members' => $this->number_of_members]
        );

        session()->flash('message', $this->house_id ? 'House updated successfully!' : 'House added successfully!');
        $this->closeModal();
    }

    public function editHouse($id)
    {
        $house = House::findOrFail($id);
        $this->house_id = $house->id;
        $this->house_name = $house->house_name;
        $this->number_of_members = $house->number_of_members;
        $this->isOpen = true;
    }

    public function deleteHouse($id)
    {
        House::findOrFail($id)->delete();
        session()->flash('message', 'House deleted successfully!');
    }
    public function goToFamilyMemberDashboard($id)
    {
        return redirect()->route('house.dashboard', ['id' => $id]);
    }
}
