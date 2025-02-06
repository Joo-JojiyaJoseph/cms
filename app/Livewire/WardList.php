<?php

namespace App\Livewire;

use App\Models\FamilyMember;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Ward;
class WardList extends Component
{
    use WithFileUploads;

    public $wards, $ward_id, $name, $image, $newImage,$members,$wardleader;
    public $isOpen = false;
    public $isOpenWardLeader = false;

    public function render()
    {
        $this->wards = Ward::all();
        $this->members = FamilyMember::all();
        return view('livewire.ward-list');
    }

    public function openModal()
    {
        $this->resetFields();
        $this->isOpen = true;
    }

    public function openModalWardLeader()
    {
        $this->resetFields();
        $this->isOpenWardLeader = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    public function closeModalLeader()
    {
        $this->isOpenWardLeader = false;
    }

    private function resetFields()
    {
        $this->ward_id = '';
        $this->name = '';
        $this->image = '';
        $this->newImage = '';
    }

    public function saveWard()
    {
        $validatedData = $this->validate([
            'name' => 'required|string',
            'newImage' => $this->ward_id ? 'nullable|image|max:1024' : 'required|image|max:1024',
        ]);

        if ($this->newImage) {
            $imageName = $this->newImage->store('wards', 'public');
        } else {
            $imageName = $this->image;
        }

        Ward::updateOrCreate(
            ['id' => $this->ward_id],
            ['name' => $this->name, 'image' => $imageName]
        );

        session()->flash('message', $this->ward_id ? 'Ward updated successfully!' : 'Ward added successfully!');

        $this->closeModal();
    }


    public function saveWardLeader()
    {
        $validatedData = $this->validate([
            'wardleader' => 'required|string',
        ]);

        // FamilyMember::updateOrCreate(
        //     ['id' => $this->wardleader],
        //     ['wardleader' => 1]
        // );
        FamilyMember::query()->update(['wardleader' => 0]);
        FamilyMember::where('id', $this->wardleader)->update(['wardleader' => 1]);

        session()->flash('message', $this->ward_id ? 'Ward Leader updated successfully!' : 'Ward Leader added successfully!');

        $this->closeModalLeader();
    }

    public function editWard($id)
    {
        $ward = Ward::findOrFail($id);
        $this->ward_id = $ward->id;
        $this->name = $ward->name;
        $this->image = $ward->image;
        $this->isOpen = true;
    }

    public function deleteWard($id)
    {
        // $ward = Ward::findOrFail($id);
        // if ($ward->image) {
        //     unlink(storage_path('app/public/' . $ward->image));
        // }
        // $ward->delete();
        // session()->flash('message', 'Ward deleted successfully!');

        try {
            $ward = Ward::findOrFail($id);

            // Optional: Delete image if exists
            if ($ward->image && file_exists(storage_path('app/public/' . $ward->image))) {
                unlink(storage_path('app/public/' . $ward->image));
            }

            $ward->delete();

            session()->flash('message', 'Ward deleted successfully!');
        } catch (\Illuminate\Database\QueryException $e) {
            session()->flash('error', 'Cannot delete ward. It is referenced in another record.');
        }
    }
    public function goToWardDashboard($id)
{
    return redirect()->route('ward.dashboard', ['id' => $id]);
}

}
