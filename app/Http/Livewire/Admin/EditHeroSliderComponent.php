<?php

namespace App\Http\Livewire\Admin;

use App\Models\Hero;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Carbon;

class EditHeroSliderComponent extends Component
{
    use WithFileUploads;
    public $title;
    public $slug;
    public $subtitle;
    public $facebook;
    public $linkedin;
    public $twitter;
    public $youtube;
    public $hero;
    public $newhero;

    public function mount($slug)
    {
        $this->hero_slug = $slug;
        $hero = Hero::where('slug', $slug)->first();
        $this->hero_id = $hero->id;
        $this->title = $hero->title;
        $this->slug = $hero->slug;
        $this->subtitle = $hero->subtitle;
        $this->facebook = $hero->facebook;
        $this->linkedin = $hero->linkedin;
        $this->twitter = $hero->twitter;
        $this->youtube = $hero->youtube;
        $this->hero = $hero->hero;
        $this->postedby = $hero->postedby;
        $this->status = $hero->status;
        $this->status = 'published';
    }

    public function generateSlug()
    {
        $placeObj = new Hero();

        $string = preg_replace('/[^A-Za-z0-9\-]/', '-', $this->title); //Removed all Special Character and replace with hyphen
        $final_slug = preg_replace('/-+/', '-', $string); //Removed double hyphen
        $heroNameURL = strtolower($final_slug);

        $this->slug = Str::slug($heroNameURL);
        //Check if this Slug already exists 
        $checkSlug = $placeObj->whereSlug($heroNameURL)->exists();

        if ($checkSlug) {
            //Slug already exists.

            //Add numerical prefix at the end. Starting with 1
            $numericalPrefix = 1;

            while (1) {
                //Check if Slug with final prefix exists.

                $newSlug = now()  . "-" . $heroNameURL . "-" . $numericalPrefix++; //new Slug with incremented Slug Numerical Prefix
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
            $this->slug = $heroNameURL;
        }
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'title' => 'required',
            'slug' => 'required',
            'subtitle' => 'required',
            'facebook' => 'required',
            'linkedin' => 'required',
            'twitter' => 'required',
            'youtube' => 'required',
        ]);
        if ($this->newhero) {
            $this->validateOnly($fields, [
                'newhero' => 'required|mimes:png,jpg,jpeg,webp',
            ]);
        }
    }

    public function updateSlider()
    {
        $this->validate([
            'title' => 'required',
            'slug' => 'required',
            'subtitle' => 'required',
            'facebook' => 'required',
            'linkedin' => 'required',
            'twitter' => 'required',
            'youtube' => 'required',

        ]);
        if ($this->newhero) {
            $this->validate([
                'newhero' => 'required|mimes:png,jpg,jpeg,webp',
            ]);
        }
        $hero = Hero::find($this->hero_id);
        $hero->title = $this->title;
        $hero->slug = $this->slug;
        $hero->subtitle = $this->subtitle;
        $hero->facebook = $this->facebook;
        $hero->linkedin = $this->linkedin;
        $hero->twitter = $this->twitter;
        $hero->youtube = $this->youtube;
        $hero->status = $this->status;
        $hero->postedby = $this->postedby;

        if ($this->newhero) {
            $imageName = Carbon::now()->timestamp . '.' . $this->newhero->extension();
            $this->newhero->storeAs('hero', $imageName);
            $hero->hero = $imageName;
        }
        $hero->save();
        session()->flash('message', 'Hero slider has been updated successfully!');
    }
    public function render()
    {
        return view('livewire.admin.edit-hero-slider-component')->layout('layouts.base');
    }
}
