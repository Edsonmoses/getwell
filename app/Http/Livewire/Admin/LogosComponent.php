<?php

namespace App\Http\Livewire\Admin;

use App\Models\Logos;
use Livewire\Component;

class LogosComponent extends Component
{
    public function render()
    {
        $logos = Logos::all();
        return view('livewire.admin.logos-component', ['logos' => $logos])->layout('layouts.base');
    }
}
