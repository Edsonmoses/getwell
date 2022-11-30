<?php

namespace App\Http\Livewire\Admin;

use App\Models\Blogs;
use Livewire\Component;

class BlogComponent extends Component
{
    public function render()
    {
        $posts = Blogs::all();
        return view('livewire.admin.blog-component', ['posts' => $posts])->layout('layouts.base');
    }
}
