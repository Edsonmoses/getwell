<?php

namespace App\Http\Livewire\Admin;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Funfacts;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;

class AddFunFactComponent extends Component
{
    use WithFileUploads;
    public $title;
    public $slug;
    public $icon;
    public $number;
    public $videoimg;
    public $video;

    public function mount()
    {
        $this->status = 'published';
        $this->postedby = Auth::user()->name;
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
        if ($this->icon) {
            $this->validateOnly($fields, [
                'icon' => 'required|mimes:png,jpg,jpeg,webp,svg',
            ]);
        }
        if ($this->videoimg) {
            $this->validateOnly($fields, [
                'videoimg' => 'required|mimes:png,jpg,jpeg,webp,svg',
            ]);
        }
    }

    public function addFunfacts()
    {
        $this->validate([
            'title' => 'required',
            'slug' => 'required',
            'number' => 'required',
            'video' => 'required',
        ]);
        if ($this->icon) {
            $this->validate([
                'icon' => 'required|mimes:png,jpg,jpeg,webp,svg',
            ]);
        }
        if ($this->videoimg) {
            $this->validate([
                'videoimg' => 'required|mimes:png,jpg,jpeg,webp,svg',
            ]);
        }
        $funfacts = new Funfacts();
        $funfacts->title = $this->title;
        $funfacts->slug = $this->slug;
        $funfacts->number = $this->number;
        $funfacts->video = $this->video;
        $funfacts->status = $this->status;
        $funfacts->postedby = $this->postedby;
        $iconName = Carbon::now()->timestamp . '.' . $this->icon->extension();
        $this->icon->storeAs('funfacts', $iconName);
        $funfacts->icon = $iconName;
        if ($this->videoimg) {
            $imageName = Carbon::now()->timestamp . '.' . $this->videoimg->extension();
            $this->videoimg->storeAs('funfacts', $imageName);
            $funfacts->videoimg = $imageName;
        }
        $funfacts->save();
        session()->flash('message', 'Funfacts has been created successfully!');
    }
    public function render()
    {
        return view('livewire.admin.add-fun-fact-component')->layout('layouts.base');
    }
}
