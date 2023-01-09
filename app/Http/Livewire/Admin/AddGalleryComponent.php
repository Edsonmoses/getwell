<?php

namespace App\Http\Livewire\Admin;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Galleries;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;

class AddGalleryComponent extends Component
{
    use WithFileUploads;
    public $name;
    public $slug;
    public $title;
    public $subtitle;
    public $image;
    public $imageBg;

    public function mount()
    {
        $this->status = 'published';
        $this->postedby = Auth::user()->name;
    }

    public function generateSlug()
    {
        $placeObj = new Galleries();

        $string = preg_replace('/[^A-Za-z0-9\-]/', '-', $this->name); //Removed all Special Character and replace with hyphen
        $final_slug = preg_replace('/-+/', '-', $string); //Removed double hyphen
        $galleryNameURL = strtolower($final_slug);

        $this->slug = Str::slug($galleryNameURL);
        //Check if this Slug already exists 
        $checkSlug = $placeObj->whereSlug($galleryNameURL)->exists();

        if ($checkSlug) {
            //Slug already exists.

            //Add numerical prefix at the end. Starting with 1
            $numericalPrefix = 1;

            while (1) {
                //Check if Slug with final prefix exists.

                $newSlug = now()  . "-" . $galleryNameURL . "-" . $numericalPrefix++; //new Slug with incremented Slug Numerical Prefix
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
            $this->slug = $galleryNameURL;
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
                'image.*' => 'required|mimes:png,jpg,jpeg,webp,svg',
            ]);
        }
        if ($this->imageBg) {
            $this->validateOnly($fields, [
                'imageBg' => 'mimes:png,jpg,jpeg,webp,svg',
            ]);
        }
    }

    public function addGallery()
    {
        $this->validate([
            'name' => 'required',
            'slug' => 'required',
        ]);
        if ($this->image) {
            $this->validate([
                'image.*' => 'required|mimes:png,jpg,jpeg,webp,svg',
            ]);
        }
        if ($this->imageBg) {
            $this->validate([
                'imageBg' => 'mimes:png,jpg,jpeg,webp,svg',
            ]);
        }
        $gallery = new Galleries();
        $gallery->name = $this->name;
        $gallery->slug = $this->slug;
        $gallery->title = $this->title;
        $gallery->subtitle = $this->subtitle;
        $gallery->status = $this->status;
        $gallery->postedby = $this->postedby;
        if ($this->image) {
            $imagesname = '';
            foreach ($this->image as $key => $image) {
                $imageName = Carbon::now()->timestamp . $key . '.' . $image->extension();
                $image->storeAs('gallery', $imageName);
                $imagesname = $imagesname . ',' . $imageName;
            }
            $gallery->image =  $imagesname;
        }
        if ($this->imageBg) {
            $imgName = Carbon::now()->timestamp . '.' . $this->imageBg->extension();
            $this->imageBg->storeAs('gallery', $imgName);
            $gallery->imageBg = $imgName;
        }
        $gallery->save();
        session()->flash('message', 'Gallery has been created successfully!');
    }
    public function render()
    {
        return view('livewire.admin.add-gallery-component')->layout('layouts.base');
    }
}
