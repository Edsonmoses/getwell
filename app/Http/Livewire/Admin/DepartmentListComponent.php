<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\DepartmentList;

class DepartmentListComponent extends Component
{
    public function render()
    {
        $departmentlist = DepartmentList::all();
        return view('livewire.admin.department-list-component', ['departmentlist' => $departmentlist])->layout('layouts.base');
    }
}
