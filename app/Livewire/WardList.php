<?php

namespace App\Livewire;

use App\Models\ward;
use Livewire\Component;
use Livewire\WithFileUploads;
class WardList extends Component
{
    use WithFileUploads;

    public $wardName;
    public $wardImage;

    public function submitForm()
    {
        // Validate the inputs
        $this->validate([
            'wardName' => 'required|string|max:255',
            'wardImage' => 'required|image|max:1024', // max size 1MB
        ]);

        // Handle image upload and save the path to the database
        $imagePath = $this->wardImage->store('wards', 'public');

        // Insert into the database
        Ward::create([
            'name' => $this->wardName,
            'image' => $imagePath,
        ]);

        // Optionally, reset the fields and refresh the list
        $this->reset(['wardName', 'wardImage']);
        session()->flash('message', 'Ward added successfully!');

        // Refresh the list of wards
        $this->emit('wardUpdated');
    }
    public function testMethod()
{
    dd('Test Method Called');
}

    public function render()
    {
        return view('livewire.ward-list');
    }
}
