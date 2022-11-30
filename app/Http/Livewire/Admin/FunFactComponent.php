<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Funfacts;

class FunFactComponent extends Component
{
    public function render()
    {
        $funfacts = Funfacts::all();
        return view('livewire.admin.fun-fact-component', ['funfacts' => $funfacts])->layout('layouts.base');
    }
}
