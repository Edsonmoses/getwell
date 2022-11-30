<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class AppointmentComponent extends Component
{
    public function render()
    {
        return view('livewire.admin.appointment-component')->layout('layouts.base');
    }
}
