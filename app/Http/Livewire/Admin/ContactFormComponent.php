<?php

namespace App\Http\Livewire\Admin;

use App\Models\Contactforms;
use Livewire\Component;

class ContactFormComponent extends Component
{
    public function render()
    {
        $contactform = Contactforms::all();
        return view('livewire.admin.contact-form-component', ['contactform' => $contactform])->layout('layouts.base');
    }
}
