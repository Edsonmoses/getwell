<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class TeamComponent extends Component
{
    public function render()
    {
        return view('livewire.admin.team-component')->layout('layouts.base');
    }
}
