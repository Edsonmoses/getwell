<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class NewsComponent extends Component
{
    public function render()
    {
        return view('livewire.admin.news-component')->layout('layouts.base');
    }
}
