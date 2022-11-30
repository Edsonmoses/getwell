<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class EditTeamComponent extends Component
{
    public function render()
    {
        return view('livewire.admin.edit-team-component')->layout('layouts.base');
    }
}
