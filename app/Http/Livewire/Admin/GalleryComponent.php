<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class GalleryComponent extends Component
{
    public function render()
    {
        return view('livewire.admin.gallery-component')->layout('layouts.base');
    }
}
