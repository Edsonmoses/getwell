<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Testimonials;

class TestimonialComponent extends Component
{
    public function render()
    {
        $testimonials = Testimonials::all();
        return view('livewire.admin.testimonial-component', ['testimonials' => $testimonials])->layout('layouts.base');
    }
}
