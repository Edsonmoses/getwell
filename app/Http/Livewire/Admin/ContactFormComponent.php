<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class ContactFormComponent extends Component
{
    public function render()
    {
        return view('livewire.admin.contact-form-component')->layout('layouts.base');
    }
}
