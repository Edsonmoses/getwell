<?php

namespace App\Http\Livewire\Admin;

use App\Models\Teams;
use Livewire\Component;

class TeamComponent extends Component
{
    public function render()
    {
        $doctors = Teams::all();
        return view('livewire.admin.team-component', ['doctors' => $doctors])->layout('layouts.base');
    }
}
