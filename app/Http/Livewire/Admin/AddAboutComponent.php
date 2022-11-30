<?php

namespace App\Http\Livewire\Admin;

use App\Models\Aboutus;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;

class AddAboutComponent extends Component
{
    use WithFileUploads;
    public $title;
    public $slug;
    public $subtitle;
    public $name;
    public $desc;
    public $avatar;
    public $aname;
    public $designation;

    public function mount()
    {
        $this->status = 'published';
        $this->postedby = Auth::user()->name;
    }

    public function generateSlug()
    {
        $placeObj = new Aboutus();

        $string = preg_replace('/[^A-Za-z0-9\-]/', '-', $this->title); //Removed all Special Character and replace with hyphen
        $final_slug = preg_replace('/-+/', '-', $string); //Removed double hyphen
        $aboutNameURL = strtolower($final_slug);

        $this->slug = Str::slug($aboutNameURL);
        //Check if this Slug already exists 
        $checkSlug = $placeObj->whereSlug($aboutNameURL)->exists();

        if ($checkSlug) {
            //Slug already exists.

            //Add numerical prefix at the end. Starting with 1
            $numericalPrefix = 1;

            while (1) {
                //Check if Slug with final prefix exists.

                $newSlug = now()  . "-" . $aboutNameURL . "-" . $numericalPrefix++; //new Slug with incremented Slug Numerical Prefix
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
            $this->slug = $aboutNameURL;
        }
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'title' => 'required',
            'slug' => 'required',
            'subtitle' => 'required',
            'name' => 'required',
            'desc' => 'required',
            'aname' => 'required',
            'designation' => 'required',
        ]);
        if ($this->avatar) {
            $this->validateOnly($fields, [
                'avatar' => 'required|mimes:png,jpg,jpeg,webp,svg',
            ]);
        }
    }

    public function addAbout()
    {
        $this->validate([
            'title' => 'required',
            'slug' => 'required',
            'subtitle' => 'required',
            'name' => 'required',
            'desc' => 'required',
            'aname' => 'required',
            'designation' => 'required',
        ]);
        if ($this->avatar) {
            $this->validate([
                'avatar' => 'required|mimes:png,jpg,jpeg,webp,svg',
            ]);
        }
        $about = new Aboutus();
        $about->title = $this->title;
        $about->slug = $this->slug;
        $about->subtitle = $this->subtitle;
        $about->name = $this->name;
        $about->desc = $this->desc;
        $about->aname = $this->aname;
        $about->designation = $this->designation;
        $about->status = $this->status;
        $about->postedby = $this->postedby;
        $imageName = Carbon::now()->timestamp . '.' . $this->avatar->extension();
        $this->avatar->storeAs('aboutus', $imageName);
        $about->avatar = $imageName;
        $about->save();
        session()->flash('message', 'About us has been created successfully!');
    }
    public function render()
    {
        return view('livewire.admin.add-about-component')->layout('layouts.base');
    }
}
