<?php

namespace App\Http\Livewire\Admin;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Features;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;

class AddFeatureComponent extends Component
{
    use WithFileUploads;
    public $title;
    public $slug;
    public $desc;
    public $image;

    public function mount()
    {
        $this->status = 'published';
        $this->postedby = Auth::user()->name;
    }

    public function generateSlug()
    {
        $placeObj = new Features();

        $string = preg_replace('/[^A-Za-z0-9\-]/', '-', $this->title); //Removed all Special Character and replace with hyphen
        $final_slug = preg_replace('/-+/', '-', $string); //Removed double hyphen
        $featuresNameURL = strtolower($final_slug);

        $this->slug = Str::slug($featuresNameURL);
        //Check if this Slug already exists 
        $checkSlug = $placeObj->whereSlug($featuresNameURL)->exists();

        if ($checkSlug) {
            //Slug already exists.

            //Add numerical prefix at the end. Starting with 1
            $numericalPrefix = 1;

            while (1) {
                //Check if Slug with final prefix exists.

                $newSlug = now()  . "-" . $featuresNameURL . "-" . $numericalPrefix++; //new Slug with incremented Slug Numerical Prefix
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
            $this->slug = $featuresNameURL;
        }
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'title' => 'required',
            'slug' => 'required',
            'desc' => 'required',
        ]);
        if ($this->image) {
            $this->validateOnly($fields, [
                'image' => 'required|mimes:png,jpg,jpeg,webp,svg',
            ]);
        }
    }

    public function addFeatures()
    {
        $this->validate([
            'title' => 'required',
            'slug' => 'required',
            'desc' => 'required',
        ]);
        if ($this->image) {
            $this->validate([
                'image' => 'required|mimes:png,jpg,jpeg,webp,svg',
            ]);
        }
        $features = new Features();
        $features->title = $this->title;
        $features->slug = $this->slug;
        $features->desc = $this->desc;
        $features->status = $this->status;
        $features->postedby = $this->postedby;
        $imageName = Carbon::now()->timestamp . '.' . $this->image->extension();
        $this->image->storeAs('features', $imageName);
        $features->image = $imageName;
        $features->save();
        session()->flash('message', 'Feature has been created successfully!');
    }
    public function render()
    {
        return view('livewire.admin.add-feature-component')->layout('layouts.base');
    }
}
