<?php

namespace App\Livewire;

use Livewire\Component;

class Ward extends Component
{
    public function testMethod()
    {
        dd('Test Method Called');
    }
    public function render()
    {
        return view('livewire.ward');
    }
}
