<?php

namespace App\Livewire;

use App\Models\ward;
use Livewire\Component;

class WardList extends Component
{
    public $wards;

    protected $listeners = ['submitForm' => 'handleSubmit', 'deleteWard' => 'handleDelete'];

    public function mount()
    {
        $this->wards = Ward::all();
    }

    public function handleSubmit($data)
{
    if ($data['action'] == 'add') {
        // Handle image upload and save
        $imagePath = null;
        if ($data['wardImage']) {
            $imagePath = $data['wardImage']->store('wards', 'public'); // Save to storage/wards directory
        }

        Ward::create([
            'name' => $data['wardName'],
            'image' => $imagePath, // Store image path
        ]);
    } elseif ($data['action'] == 'edit') {
        $ward = Ward::find($data['wardId']);

        // Check if an image is being uploaded
        if ($data['wardImage']) {
            // Delete the old image from storage (optional, if you want to replace the old image)
            if ($ward->image && file_exists(storage_path('app/public/' . $ward->image))) {
                unlink(storage_path('app/public/' . $ward->image));
            }

            // Store the new image
            $imagePath = $data['wardImage']->store('wards', 'public');
        } else {
            // Keep the existing image if no new one is uploaded
            $imagePath = $ward->image;
        }

        $ward->update([
            'name' => $data['wardName'],
            'image' => $imagePath, // Save the new image path or keep the old one
        ]);
    }

    $this->wards = Ward::all(); // Refresh the list of wards
}


    public function handleDelete($wardId)
    {
        Ward::find($wardId)->delete();
        $this->wards = Ward::all(); // Refresh the list
    }

    public function render()
    {
        return view('livewire.ward-list');
    }
}
