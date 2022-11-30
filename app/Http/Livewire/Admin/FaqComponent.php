<?php

namespace App\Http\Livewire\Admin;

use App\Models\Faqs;
use Livewire\Component;

class FaqComponent extends Component
{
    public function render()
    {
        $faqs = Faqs::all();
        return view('livewire.admin.faq-component', ['faqs' => $faqs])->layout('layouts.base');
    }
}
