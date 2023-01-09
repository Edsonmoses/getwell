<?php

namespace App\Http\Livewire\Admin;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Galleries;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class EditGalleryComponent extends Component
{
    use WithFileUploads;
    public $name;
    public $slug;
    public $title;
    public $subtitle;
    public $image;
    public $newimage;
    public $imageBg;
    public $newimageBg;

    public function mount($slug)
    {
        $this->gallery_slug = $slug;
        $gallery = Galleries::where('slug', $slug)->first();
        $this->gallery_id = $gallery->id;
        $this->name = $gallery->name;
        $this->slug = $gallery->slug;
        $this->title = $gallery->title;
        $this->subtitle = $gallery->subtitle;
        $this->imageBg = $gallery->imageBg;
        $this->image = explode(",", $gallery->image);
        $this->postedby = $gallery->postedby;
        $this->status = $gallery->status;
        $this->status = 'published';
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
        if ($this->newimage) {
            $this->validateOnly($fields, [
                'newimage' => 'required|mimes:png,jpg,jpeg,webp,svg',
            ]);
        }
        if ($this->newimageBg) {
            $this->validateOnly($fields, [
                'newimageBg' => 'required|mimes:png,jpg,jpeg,webp,svg',
            ]);
        }
    }

    public function updateGallery()
    {
        $this->validate([
            'name' => 'required',
            'slug' => 'required',
        ]);
        if ($this->newimage) {
            $this->validate([
                'newimage' => 'required|mimes:png,jpg,jpeg,webp,svg',
            ]);
        }
        if ($this->newimageBg) {
            $this->validate([
                'newimageBg' => 'mimes:png,jpg,jpeg,webp,svg',
            ]);
        }
        $gallery = Galleries::find($this->gallery_id);
        $gallery->name = $this->name;
        $gallery->slug = $this->slug;
        $gallery->title = $this->title;
        $gallery->subtitle = $this->subtitle;
        $gallery->status = $this->status;
        $gallery->postedby = $this->postedby;
        if ($this->newimage) {
            $imagesname = '';
            foreach ($this->newimage as $key => $image) {
                $imageName = Carbon::now()->timestamp . $key . '.' . $image->extension();
                $image->storeAs('gallery', $imageName);
                $imagesname = $imagesname . ',' . $imageName;
            }
            $gallery->image =  $imagesname;
        }
        if ($this->newimageBg) {
            $imgName = Carbon::now()->timestamp . '.' . $this->newimageBg->extension();
            $this->newimageBg->storeAs('gallery', $imgName);
            $gallery->imageBg = $imgName;
        }
        $gallery->save();
        session()->flash('message', 'Gallery has been updated successfully!');
    }
    public function render()
    {
        return view('livewire.admin.edit-gallery-component')->layout('layouts.base');
    }
}
