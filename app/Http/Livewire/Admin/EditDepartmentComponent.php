<?php

namespace App\Http\Livewire\Admin;

use Carbon\Carbon;
use App\Models\Working;
use Livewire\Component;
use App\Models\Departments;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use App\Models\DepartmentList;

class EditDepartmentComponent extends Component
{
    use WithFileUploads;
    public $title;
    public $slug;
    public $subtitle;
    public $desc;
    public $image;
    public $newimage;
    public $toptitle;
    public $topsubtitle;
    public $department_id;
    public $timetable_id;

    public function mount($slug)
    {
        $this->departments_slug = $slug;
        $departments = Departments::where('slug', $slug)->first();
        $this->departments_id = $departments->id;
        $this->title = $departments->title;
        $this->slug = $departments->slug;
        $this->subtitle = $departments->subtitle;
        $this->desc = $departments->desc;
        $this->toptitle = $departments->toptitle;
        $this->topsubtitle = $departments->topsubtitle;
        $this->department_id = $departments->department_id;
        $this->timetable_id = $departments->timetable_id;
        $this->image = $departments->image;
        $this->postedby = $departments->postedby;
        $this->status = $departments->status;
        $this->status = 'published';
    }

    public function generateSlug()
    {
        $placeObj = new Departments();

        $string = preg_replace('/[^A-Za-z0-9\-]/', '-', $this->title); //Removed all Special Character and replace with hyphen
        $final_slug = preg_replace('/-+/', '-', $string); //Removed double hyphen
        $departmentsNameURL = strtolower($final_slug);

        $this->slug = Str::slug($departmentsNameURL);
        //Check if this Slug already exists 
        $checkSlug = $placeObj->whereSlug($departmentsNameURL)->exists();

        if ($checkSlug) {
            //Slug already exists.

            //Add numerical prefix at the end. Starting with 1
            $numericalPrefix = 1;

            while (1) {
                //Check if Slug with final prefix exists.

                $newSlug = now()  . "-" . $departmentsNameURL . "-" . $numericalPrefix++; //new Slug with incremented Slug Numerical Prefix
                $newSlug = Str::slug($newSlug); //String Slug


                $checkSlug = $placeObj->whereSlug($newSlug)->exists(); //Check if already exists in DB
                //This returns true if exists.

                if (!$checkSlug) {

                    //There is not more coincidence. Finally found unique slug.
                    $this->slug = $newSlug; //New Slug 

                    break; //Break Loop

                }
            }
        } else {
            //Slug do not exists. Just use the selected Slug.
            $this->slug = $departmentsNameURL;
        }
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'title' => 'required',
            'slug' => 'required',
            'subtitle' => 'required',
            'desc' => 'required',
            'department_id' => 'required',
            'timetable_id' => 'required',
        ]);
        if ($this->newimage) {
            $this->validateOnly($fields, [
                'newimage' => 'required|mimes:png,jpg,jpeg,webp,svg',
            ]);
        }
    }

    public function updateDepartments()
    {
        $this->validate([
            'title' => 'required',
            'slug' => 'required',
            'subtitle' => 'required',
            'desc' => 'required',
            'department_id' => 'required',
            'timetable_id' => 'required',
        ]);
        if ($this->newimage) {
            $this->validate([
                'newimage' => 'required|mimes:png,jpg,jpeg,webp,svg',
            ]);
        }
        $departments = Departments::find($this->departments_id);
        $departments->title = $this->title;
        $departments->slug = $this->slug;
        $departments->subtitle = $this->subtitle;
        $departments->desc = $this->desc;
        $departments->toptitle = $this->toptitle;
        $departments->topsubtitle = $this->topsubtitle;
        $departments->department_id = $this->department_id;
        $departments->timetable_id = $this->timetable_id;
        $departments->status = $this->status;
        $departments->postedby = $this->postedby;
        if ($this->newimage) {
            $imageName = Carbon::now()->timestamp . '.' . $this->newimage->extension();
            $this->newimage->storeAs('departments', $imageName);
            $departments->image = $imageName;
        }
        $departments->save();
        session()->flash('message', 'Department has been updated successfully!');
    }
    public function render()
    {
        $departmentl = DepartmentList::all();
        $timetable = Working::all();
        return view('livewire.admin.edit-department-component', ['departmentl' => $departmentl, 'timetable' => $timetable])->layout('layouts.base');
    }
}
