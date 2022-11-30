<?php

namespace App\Http\Livewire\Admin;

use App\Models\Departments;
use Livewire\Component;

class DepartmentComponent extends Component
{
    public function render()
    {
        $departments = Departments::all();
        return view('livewire.admin.department-component', ['departments' => $departments])->layout('layouts.base');
    }
}
