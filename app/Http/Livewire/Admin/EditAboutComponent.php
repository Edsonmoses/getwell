<?php

namespace App\Http\Livewire\Admin;

use Carbon\Carbon;
use App\Models\Aboutus;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class EditAboutComponent extends Component
{
    use WithFileUploads;
    public $title;
    public $slug;
    public $subtitle;
    public $name;
    public $desc;
    public $avatar;
    public $newavatar;
    public $aname;
    public $designation;

    public function mount($slug)
    {
        $this->about_slug = $slug;
        $about = Aboutus::where('slug', $slug)->first();
        $this->about_id = $about->id;
        $this->title = $about->title;
        $this->slug = $about->slug;
        $this->subtitle = $about->subtitle;
        $this->name = $about->name;
        $this->desc = $about->desc;
        $this->avatar = $about->avatar;
        $this->aname = $about->aname;
        $this->designation = $about->designation;
        $this->postedby = $about->postedby;
        $this->status = $about->status;
        $this->status = 'published';
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
        if ($this->newavatar) {
            $this->validateOnly($fields, [
                'newavatar' => 'required|mimes:png,jpg,jpeg,webp,svg',
            ]);
        }
    }

    public function updateAbout()
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
        if ($this->newavatar) {
            $this->validate([
                'newavatar' => 'required|mimes:png,jpg,jpeg,webp,svg',
            ]);
        }
        $about = Aboutus::find($this->about_id);
        $about->title = $this->title;
        $about->slug = $this->slug;
        $about->subtitle = $this->subtitle;
        $about->name = $this->name;
        $about->desc = $this->desc;
        $about->aname = $this->aname;
        $about->designation = $this->designation;
        $about->status = $this->status;
        if ($this->newavatar) {
            $imageName = Carbon::now()->timestamp . '.' . $this->newavatar->extension();
            $this->newavatar->storeAs('aboutus', $imageName);
            $about->avatar = $imageName;
        }
        $about->save();
        session()->flash('message', 'About us has been updated successfully!');
    }
    public function render()
    {
        return view('livewire.admin.edit-about-component')->layout('layouts.base');
    }
}
