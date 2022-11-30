<?php

namespace App\Http\Livewire\Admin;

use Carbon\Carbon;
use App\Models\Faqs;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class EditFaqComponent extends Component
{
    use WithFileUploads;
    public $title;
    public $slug;
    public $body;
    public $heading;
    public $faqbg;
    public $newfaqbg;
    public $faqimg;
    public $newfaqimg;

    public function mount($slug)
    {
        $this->faqs_slug = $slug;
        $faqs = Faqs::where('slug', $slug)->first();
        $this->faqs_id = $faqs->id;
        $this->title = $faqs->title;
        $this->slug = $faqs->slug;
        $this->body = $faqs->body;
        $this->heading = $faqs->heading;
        $this->faqbg = $faqs->faqbg;
        $this->faqimg = $faqs->faqimg;
        $this->postedby = $faqs->postedby;
        $this->status = $faqs->status;
        $this->status = 'published';
    }

    public function generateSlug()
    {
        $placeObj = new Faqs();

        $string = preg_replace('/[^A-Za-z0-9\-]/', '-', $this->title); //Removed all Special Character and replace with hyphen
        $final_slug = preg_replace('/-+/', '-', $string); //Removed double hyphen
        $faqsNameURL = strtolower($final_slug);

        $this->slug = Str::slug($faqsNameURL);
        //Check if this Slug already exists 
        $checkSlug = $placeObj->whereSlug($faqsNameURL)->exists();

        if ($checkSlug) {
            //Slug already exists.

            //Add numerical prefix at the end. Starting with 1
            $numericalPrefix = 1;

            while (1) {
                //Check if Slug with final prefix exists.

                $newSlug = now()  . "-" . $faqsNameURL . "-" . $numericalPrefix++; //new Slug with incremented Slug Numerical Prefix
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
            $this->slug = $faqsNameURL;
        }
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'title' => 'required',
            'slug' => 'required',
            'body' => 'required',
        ]);
        if ($this->newfaqbg) {
            $this->validateOnly($fields, [
                'newfaqbg' => 'required|mimes:png,jpg,jpeg,webp',
            ]);
        }
        if ($this->newfaqimg) {
            $this->validateOnly($fields, [
                'newfaqimg' => 'required|mimes:png,jpg,jpeg,webp',
            ]);
        }
    }

    public function updateFaqs()
    {
        $this->validate([
            'title' => 'required',
            'slug' => 'required',
            'body' => 'required',
        ]);
        if ($this->newfaqbg) {
            $this->validate([
                'newfaqbg' => 'required|mimes:png,jpg,jpeg,webp',
            ]);
        }
        if ($this->newfaqimg) {
            $this->validate([
                'newfaqimg' => 'required|mimes:png,jpg,jpeg,webp',
            ]);
        }
        $faqs = Faqs::find($this->faqs_id);
        $faqs->title = $this->title;
        $faqs->slug = $this->slug;
        $faqs->body = $this->body;
        $faqs->heading = $this->heading;
        $faqs->status = $this->status;
        $faqs->postedby = $this->postedby;
        if ($this->newfaqbg) {
            $imageName = Carbon::now()->timestamp . '.' . $this->newfaqbg->extension();
            $this->newfaqbg->storeAs('faqs', $imageName);
            $faqs->faqbg = $imageName;
        }
        if ($this->newfaqimg) {
            $imageName = Carbon::now()->timestamp . '.' . $this->newfaqimg->extension();
            $this->newfaqimg->storeAs('faqs', $imageName);
            $faqs->faqimg = $imageName;
        }
        $faqs->save();
        session()->flash('message', 'Faq has been created successfully!');
    }
    public function render()
    {
        return view('livewire.admin.edit-faq-component')->layout('layouts.base');
    }
}
