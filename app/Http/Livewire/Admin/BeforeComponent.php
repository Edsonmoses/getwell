<?php

namespace App\Http\Livewire\Admin;

use App\Models\Befores;
use Livewire\Component;

class BeforeComponent extends Component
{
    public function render()
    {
        $before = Befores::all();
        return view('livewire.admin.before-component', ['before' => $before])->layout('layouts.base');
    }
}
