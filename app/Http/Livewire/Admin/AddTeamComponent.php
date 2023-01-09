<?php

namespace App\Http\Livewire\Admin;

use App\Models\DepartmentList;
use Carbon\Carbon;
use App\Models\Teams;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;

class AddTeamComponent extends Component
{
    use WithFileUploads;
    public $name;
    public $slug;
    public $designation;
    public $desc;
    public $image;
    public $bio;
    public $education;
    public $specialeft;
    public $specialr;
    public $address;
    public $email;
    public $phone;
    public $hours;
    public $facebook;
    public $linkedin;
    public $twitter;
    public $title;
    public $subtitle;
    public $department_id;

    public function mount()
    {
        $this->status = 'published';
        $this->postedby = Auth::user()->name;
    }

    public function generateSlug()
    {
        $placeObj = new Teams();

        $string = preg_replace('/[^A-Za-z0-9\-]/', '-', $this->name); //Removed all Special Character and replace with hyphen
        $final_slug = preg_replace('/-+/', '-', $string); //Removed double hyphen
        $teamsNameURL = strtolower($final_slug);

        $this->slug = Str::slug($teamsNameURL);
        //Check if this Slug already exists 
        $checkSlug = $placeObj->whereSlug($teamsNameURL)->exists();

        if ($checkSlug) {
            //Slug already exists.

            //Add numerical prefix at the end. Starting with 1
            $numericalPrefix = 1;

            while (1) {
                //Check if Slug with final prefix exists.

                $newSlug = now()  . "-" . $teamsNameURL . "-" . $numericalPrefix++; //new Slug with incremented Slug Numerical Prefix
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
            $this->slug = $teamsNameURL;
        }
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'required',
            'slug' => 'required',
            'designation' => 'required',
            'desc' => 'required',
            'bio' => 'required',
            'education' => 'required',
            'specialeft' => 'required',
            'specialr' => 'required',
            'address' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'hours' => 'required',
            'facebook' => 'required',
            'linkedin' => 'required',
            'twitter' => 'required',
            'department_id' => 'required',
        ]);
        if ($this->image) {
            $this->validateOnly($fields, [
                'image' => 'required|mimes:png,jpg,jpeg,webp,svg',
            ]);
        }
    }

    public function addTeams()
    {
        $this->validate([
            'name' => 'required',
            'slug' => 'required',
            'designation' => 'required',
            'desc' => 'required',
            'bio' => 'required',
            'education' => 'required',
            'specialeft' => 'required',
            'specialr' => 'required',
            'address' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'hours' => 'required',
            'facebook' => 'required',
            'linkedin' => 'required',
            'twitter' => 'required',
            'department_id' => 'required',
        ]);
        if ($this->image) {
            $this->validate([
                'image' => 'required|mimes:png,jpg,jpeg,webp,svg',
            ]);
        }
        $teams = new Teams();
        $teams->name = $this->name;
        $teams->slug = $this->slug;
        $teams->designation = $this->designation;
        $teams->desc = $this->desc;
        $teams->bio = $this->bio;
        $teams->education = str_replace("\n", '|', trim($this->education));
        $teams->specialeft = str_replace("\n", ',', trim($this->specialeft));
        $teams->specialr = str_replace("\n", '|', trim($this->specialr));
        $teams->address = $this->address;
        $teams->email = $this->email;
        $teams->phone = $this->phone;
        $teams->hours = str_replace("\n", '|', trim($this->hours));
        $teams->facebook = $this->facebook;
        $teams->linkedin = $this->linkedin;
        $teams->twitter = $this->twitter;
        $teams->title = $this->title;
        $teams->subtitle = $this->subtitle;
        $teams->department_id = $this->department_id;
        $teams->status = $this->status;
        $teams->postedby = $this->postedby;
        $imageName = Carbon::now()->timestamp . '.' . $this->image->extension();
        $this->image->storeAs('teams', $imageName);
        $teams->image = $imageName;
        $teams->save();
        session()->flash('message', 'Teams has been created successfully!');
    }
    public function render()
    {
        $departmentlists  = DepartmentList::all();
        return view('livewire.admin.add-team-component', ['departmentlists' => $departmentlists])->layout('layouts.base');
    }
}
