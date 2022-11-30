<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class ClosedAppointmentComponent extends Component
{
    public function render()
    {
        return view('livewire.admin.closed-appointment-component')->layout('layouts.base');
    }
}
