<?php

namespace App\Http\Livewire\Admin;

use App\Models\Features;
use Livewire\Component;

class FeatureComponent extends Component
{
    public function render()
    {
        $features = Features::all();
        return view('livewire.admin.feature-component', ['features' => $features])->layout('layouts.base');
    }
}
