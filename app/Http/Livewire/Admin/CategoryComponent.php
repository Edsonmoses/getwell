<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use Livewire\Component;

class CategoryComponent extends Component
{
    public function render()
    {
        $categories = Category::all();
        return view('livewire.admin.category-component', ['categories' => $categories])->layout('layouts.base');
    }
}
