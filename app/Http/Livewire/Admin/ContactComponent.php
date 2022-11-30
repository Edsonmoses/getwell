<?php

namespace App\Http\Livewire\Admin;

use App\Models\Contacts;
use Livewire\Component;

class ContactComponent extends Component
{
    public function render()
    {
        $contacts = Contacts::all();
        return view('livewire.admin.contact-component', ['contacts' => $contacts])->layout('layouts.base');
    }
}
