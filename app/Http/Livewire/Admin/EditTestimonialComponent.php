<?php

namespace App\Http\Livewire\Admin;

use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Testimonials;
use Livewire\WithFileUploads;

class EditTestimonialComponent extends Component
{
    use WithFileUploads;
    public $name;
    public $slug;
    public $designation;
    public $text;
    public $image;
    public $newimage;
    public $title;
    public $subtitle;

    public function mount($slug)
    {
        $this->testimonials_slug = $slug;
        $testimonials = Testimonials::where('slug', $slug)->first();
        $this->testimonials_id = $testimonials->id;
        $this->name = $testimonials->name;
        $this->slug = $testimonials->slug;
        $this->designation = $testimonials->designation;
        $this->text = $testimonials->text;
        $this->image = $testimonials->image;
        $this->title = $testimonials->title;
        $this->subtitle = $testimonials->subtitle;
        $this->postedby = $testimonials->postedby;
        $this->status = $testimonials->status;
        $this->status = 'published';
    }

    public function generateSlug()
    {
        $placeObj = new Testimonials();

        $string = preg_replace('/[^A-Za-z0-9\-]/', '-', $this->name); //Removed all Special Character and replace with hyphen
        $final_slug = preg_replace('/-+/', '-', $string); //Removed double hyphen
        $testimonialsNameURL = strtolower($final_slug);

        $this->slug = Str::slug($testimonialsNameURL);
        //Slug do not exists. Just use the selected Slug.
        $this->slug = $testimonialsNameURL;
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
        if ($this->newimage) {
            $this->validateOnly($fields, [
                'newimage' => 'required|mimes:png,jpg,jpeg,webp,svg',
            ]);
        }
    }

    public function updateTestimonials()
    {
        $this->validate([
            'name' => 'required',
            'slug' => 'required',
            'designation' => 'required',
            'text' => 'required',
            'title' => 'required',
            'subtitle' => 'required',
        ]);
        if ($this->newimage) {
            $this->validate([
                'newimage' => 'required|mimes:png,jpg,jpeg,webp,svg',
            ]);
        }
        $testimonials = Testimonials::find($this->testimonials_id);
        $testimonials->name = $this->name;
        $testimonials->slug = $this->slug;
        $testimonials->designation = $this->designation;
        $testimonials->text = $this->text;
        $testimonials->title = $this->title;
        $testimonials->subtitle = $this->subtitle;
        $testimonials->status = $this->status;
        $testimonials->postedby = $this->postedby;
        if ($this->newimage) {
            $imageName = Carbon::now()->timestamp . '.' . $this->newimage->extension();
            $this->newimage->storeAs('testimonials', $imageName);
            $testimonials->image = $imageName;
        }
        $testimonials->save();
        session()->flash('message', 'Testimonials has been created successfully!');
    }
    public function render()
    {
        return view('livewire.admin.edit-testimonial-component')->layout('layouts.base');
    }
}
