<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class EditNewsComponent extends Component
{
    public function render()
    {
        return view('livewire.admin.edit-news-component')->layout('layouts.base');
    }
}
