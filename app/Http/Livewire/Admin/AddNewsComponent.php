<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class AddNewsComponent extends Component
{
    public function render()
    {
        return view('livewire.admin.add-news-component')->layout('layouts.base');
    }
}
