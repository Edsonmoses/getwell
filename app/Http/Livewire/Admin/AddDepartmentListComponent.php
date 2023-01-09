<?php

namespace App\Http\Livewire\Admin;

use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use App\Models\DepartmentList;
use Illuminate\Support\Facades\Auth;

class AddDepartmentListComponent extends Component
{
    use WithFileUploads;
    public $name;
    public $slug;
    public $image;

    public function mount()
    {
        $this->status = 'published';
        $this->postedby = Auth::user()->name;
    }

    public function generateSlug()
    {
        $placeObj = new DepartmentList();

        $string = preg_replace('/[^A-Za-z0-9\-]/', '-', $this->name); //Removed all Special Character and replace with hyphen
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
            'name' => 'required',
            'slug' => 'required',
        ]);
        if ($this->image) {
            $this->validateOnly($fields, [
                'image' => 'required|mimes:png,jpg,jpeg,webp,svg',
            ]);
        }
    }

    public function addDepartment()
    {
        $this->validate([
            'name' => 'required',
            'slug' => 'required',
        ]);
        if ($this->image) {
            $this->validate([
                'image' => 'required|mimes:png,jpg,jpeg,webp,svg',
            ]);
        }
        $departments = new DepartmentList();
        $departments->name = $this->name;
        $departments->slug = $this->slug;
        $departments->status = $this->status;
        $departments->postedby = $this->postedby;
        $imageName = Carbon::now()->timestamp . '.' . $this->image->extension();
        $this->image->storeAs('departmentlist', $imageName);
        $departments->image = $imageName;
        $departments->save();
        session()->flash('message', 'Department category has been created successfully!');
    }
    public function render()
    {
        return view('livewire.admin.add-department-list-component')->layout('layouts.base');
    }
}
