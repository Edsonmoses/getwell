<?php

namespace App\Http\Livewire\Admin;

use App\Models\Hero;
use Livewire\Component;

class HeroSliderComponent extends Component
{
    public function render()
    {
        $heros = Hero::all();
        return view('livewire.admin.hero-slider-component', ['heros' => $heros])->layout('layouts.base');
    }
}
