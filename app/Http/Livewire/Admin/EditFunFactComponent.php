<?php

namespace App\Http\Livewire\Admin;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Funfacts;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class EditFunFactComponent extends Component
{
    use WithFileUploads;
    public $title;
    public $slug;
    public $icon;
    public $newicon;
    public $number;
    public $videoimg;
    public $newvideoimg;
    public $video;

    public function mount($slug)
    {
        $this->funfacts_slug = $slug;
        $funfacts = Funfacts::where('slug', $slug)->first();
        $this->funfacts_id = $funfacts->id;
        $this->title = $funfacts->title;
        $this->slug = $funfacts->slug;
        $this->icon = $funfacts->icon;
        $this->number = $funfacts->number;
        $this->videoimg = $funfacts->videoimg;
        $this->video = $funfacts->video;
        $this->postedby = $funfacts->postedby;
        $this->status = $funfacts->status;
        $this->status = 'published';
    }

    public function generateSlug()
    {
        $placeObj = new Funfacts();

        $string = preg_replace('/[^A-Za-z0-9\-]/', '-', $this->title); //Removed all Special Character and replace with hyphen
        $final_slug = preg_replace('/-+/', '-', $string); //Removed double hyphen
        $funfactsNameURL = strtolower($final_slug);

        $this->slug = Str::slug($funfactsNameURL);
        //Check if this Slug already exists 
        $checkSlug = $placeObj->whereSlug($funfactsNameURL)->exists();

        if ($checkSlug) {
            //Slug already exists.

            //Add numerical prefix at the end. Starting with 1
            $numericalPrefix = 1;

            while (1) {
                //Check if Slug with final prefix exists.

                $newSlug = now()  . "-" . $funfactsNameURL . "-" . $numericalPrefix++; //new Slug with incremented Slug Numerical Prefix
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
            $this->slug = $funfactsNameURL;
        }
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'title' => 'required',
            'slug' => 'required',
            'number' => 'required',
            'video' => 'required',
        ]);
        if ($this->newicon) {
            $this->validateOnly($fields, [
                'newicon' => 'required|mimes:png,jpg,jpeg,webp,svg',
            ]);
        }
        if ($this->newvideoimg) {
            $this->validateOnly($fields, [
                'newvideoimg' => 'required|mimes:png,jpg,jpeg,webp,svg',
            ]);
        }
    }

    public function updateFunfacts()
    {
        $this->validate([
            'title' => 'required',
            'slug' => 'required',
            'number' => 'required',
            'video' => 'required',
        ]);
        if ($this->newicon) {
            $this->validate([
                'newicon' => 'required|mimes:png,jpg,jpeg,webp,svg',
            ]);
        }
        if ($this->newvideoimg) {
            $this->validate([
                'newvideoimg' => 'required|mimes:png,jpg,jpeg,webp,svg',
            ]);
        }
        $funfacts = Funfacts::find($this->funfacts_id);
        $funfacts->title = $this->title;
        $funfacts->slug = $this->slug;
        $funfacts->number = $this->number;
        $funfacts->video = $this->video;
        $funfacts->status = $this->status;
        $funfacts->postedby = $this->postedby;
        if ($this->newicon) {
            $iconName = Carbon::now()->timestamp . '.' . $this->newicon->extension();
            $this->newicon->storeAs('funfacts', $iconName);
            $funfacts->icon = $iconName;
        }
        if ($this->newvideoimg) {
            $imageName = Carbon::now()->timestamp . '.' . $this->newvideoimg->extension();
            $this->newvideoimg->storeAs('funfacts', $imageName);
            $funfacts->videoimg = $imageName;
        }
        $funfacts->save();
        session()->flash('message', 'Funfacts has been created successfully!');
    }
    public function render()
    {
        return view('livewire.admin.edit-fun-fact-component')->layout('layouts.base');
    }
}
