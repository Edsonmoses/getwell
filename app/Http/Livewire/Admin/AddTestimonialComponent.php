<?php

namespace App\Http\Livewire\Admin;

use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Testimonials;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;

class AddTestimonialComponent extends Component
{
    use WithFileUploads;
    public $name;
    public $slug;
    public $designation;
    public $text;
    public $image;
    public $title;
    public $subtitle;

    public function mount()
    {
        $this->status = 'published';
        $this->postedby = Auth::user()->name;
    }

    public function generateSlug()
    {
        $placeObj = new Testimonials();

        $string = preg_replace('/[^A-Za-z0-9\-]/', '-', $this->name); //Removed all Special Character and replace with hyphen
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
            'name' => 'required',
            'slug' => 'required',
            'designation' => 'required',
            'text' => 'required',
            'title' => 'required',
            'subtitle' => 'required',
        ]);
        if ($this->image) {
            $this->validateOnly($fields, [
                'image' => 'required|mimes:png,jpg,jpeg,webp,svg',
            ]);
        }
    }

    public function addTestimonials()
    {
        $this->validate([
            'name' => 'required',
            'slug' => 'required',
            'designation' => 'required',
            'text' => 'required',
            'title' => 'required',
            'subtitle' => 'required',
        ]);
        if ($this->image) {
            $this->validate([
                'image' => 'required|mimes:png,jpg,jpeg,webp,svg',
            ]);
        }
        $testimonials = new Testimonials();
        $testimonials->name = $this->name;
        $testimonials->slug = $this->slug;
        $testimonials->designation = $this->designation;
        $testimonials->text = $this->text;
        $testimonials->title = $this->title;
        $testimonials->subtitle = $this->subtitle;
        $testimonials->status = $this->status;
        $testimonials->postedby = $this->postedby;
        $imageName = Carbon::now()->timestamp . '.' . $this->image->extension();
        $this->image->storeAs('testimonials', $imageName);
        $testimonials->image = $imageName;
        $testimonials->save();
        session()->flash('message', 'Testimonials has been created successfully!');
    }
    public function render()
    {
        return view('livewire.admin.add-testimonial-component')->layout('layouts.base');
    }
}
