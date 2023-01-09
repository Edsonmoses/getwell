<?php

namespace App\Http\Livewire\Admin;

use Carbon\Carbon;
use App\Models\Teams;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use App\Models\DepartmentList;
use Illuminate\Support\Facades\Auth;

class EditTeamComponent extends Component
{
    use WithFileUploads;
    public $name;
    public $slug;
    public $designation;
    public $desc;
    public $image;
    public $newimage;
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

    public function mount($slug)
    {
        $this->teams_slug = $slug;
        $teams = Teams::where('slug', $slug)->first();
        $this->teams_id = $teams->id;
        $this->name = $teams->name;
        $this->slug = $teams->slug;
        $this->designation = $teams->designation;
        $this->desc = $teams->desc;
        $this->image = $teams->image;
        $this->bio = $teams->bio;
        $this->education = str_replace("\n", '|', trim($teams->education));
        $this->specialeft = str_replace("\n", '|', trim($teams->specialeft));
        $this->specialr = str_replace("\n", '|', trim($teams->specialr));
        $this->address = $teams->address;
        $this->email = $teams->email;
        $this->phone = $teams->phone;
        $this->hours = str_replace("\n", '|', trim($teams->hours));
        $this->facebook = $teams->facebook;
        $this->linkedin = $teams->linkedin;
        $this->twitter = $teams->twitter;
        $this->title = $teams->title;
        $this->subtitle = $teams->subtitle;
        $this->department_id = $teams->department_id;
        $this->postedby = $teams->postedby;
        $this->status = $teams->status;
        $this->status = 'published';
    }

    public function generateSlug()
    {
        $placeObj = Teams::find($this->teams_id);

        $string = preg_replace('/[^A-Za-z0-9\-]/', '-', $this->name); //Removed all Special Character and replace with hyphen
        $final_slug = preg_replace('/-+/', '-', $string); //Removed double hyphen
        $teamsNameURL = strtolower($final_slug);

        $this->slug = Str::slug($teamsNameURL);
        //Slug do not exists. Just use the selected Slug.
        $this->slug = $teamsNameURL;
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
        if ($this->newimage) {
            $this->validateOnly($fields, [
                'newimage' => 'required|mimes:png,jpg,jpeg,webp,svg',
            ]);
        }
    }

    public function updateTeams()
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
        if ($this->newimage) {
            $this->validate([
                'newimage' => 'required|mimes:png,jpg,jpeg,webp,svg',
            ]);
        }
        $teams = Teams::find($this->teams_id);
        $teams->name = $this->name;
        $teams->slug = $this->slug;
        $teams->designation = $this->designation;
        $teams->desc = $this->desc;
        $teams->bio = $this->bio;
        $teams->education = str_replace("\n", '|', trim($this->education));
        $teams->specialeft = str_replace("\n", '|', trim($this->specialeft));
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
        if ($this->newimage) {
            $imageName = Carbon::now()->timestamp . '.' . $this->newimage->extension();
            $this->newimage->storeAs('teams', $imageName);
            $teams->image = $imageName;
        }
        $teams->save();
        session()->flash('message', 'Teams has been updated successfully!');
    }
    public function render()
    {
        $departmentlists  = DepartmentList::all();
        return view('livewire.admin.edit-team-component', ['departmentlists' => $departmentlists])->layout('layouts.base');
    }
}
