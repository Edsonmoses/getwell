<?php

namespace App\Http\Livewire\Admin;

use App\Models\Aboutus;
use Livewire\Component;

class AboutComponent extends Component
{
    public function render()
    {
        $aboutus = Aboutus::all();
        return view('livewire.admin.about-component', ['aboutus' => $aboutus])->layout('layouts.base');
    }
}
