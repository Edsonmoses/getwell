<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Galleries;

class GalleryComponent extends Component
{
    public function render()
    {
        $galleries = Galleries::all();
        return view('livewire.admin.gallery-component', ['galleries' => $galleries])->layout('layouts.base');
    }
}
