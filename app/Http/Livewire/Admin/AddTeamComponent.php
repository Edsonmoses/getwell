<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class AddTeamComponent extends Component
{
    public function render()
    {
        return view('livewire.admin.add-team-component')->layout('layouts.base');
    }
}
