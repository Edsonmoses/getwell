<?php

namespace App\Http\Livewire\Admin;

use Carbon\Carbon;
use App\Models\Faqs;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;

class AddFaqComponent extends Component
{
    use WithFileUploads;
    public $title;
    public $slug;
    public $body;
    public $heading;
    public $faqbg;
    public $faqimg;

    public function mount()
    {
        $this->status = 'published';
        $this->postedby = Auth::user()->name;
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
        if ($this->faqbg) {
            $this->validateOnly($fields, [
                'faqbg' => 'mimes:png,jpg,jpeg,webp,svg',
            ]);
        }
        if ($this->faqimg) {
            $this->validateOnly($fields, [
                'faqimg' => 'mimes:png,jpg,jpeg,webp,svg',
            ]);
        }
    }

    public function addFaqs()
    {
        $this->validate([
            'title' => 'required',
            'slug' => 'required',
            'body' => 'required',
        ]);
        if ($this->faqbg) {
            $this->validate([
                'faqbg' => 'mimes:png,jpg,jpeg,webp,svg',
            ]);
        }
        if ($this->faqimg) {
            $this->validate([
                'faqimg' => 'mimes:png,jpg,jpeg,webp,svg',
            ]);
        }
        $faqs = new Faqs();
        $faqs->title = $this->title;
        $faqs->slug = $this->slug;
        $faqs->body = $this->body;
        $faqs->heading = $this->heading;
        $faqs->status = $this->status;
        $faqs->postedby = $this->postedby;
        if ($this->faqbg) {
            $imageName = Carbon::now()->timestamp . '.' . $this->faqbg->extension();
            $this->faqbg->storeAs('faqs', $imageName);
            $faqs->faqbg = $imageName;
        }
        if ($this->faqimg) {
            $imageName = Carbon::now()->timestamp . '.' . $this->faqimg->extension();
            $this->faqimg->storeAs('faqs', $imageName);
            $faqs->faqimg = $imageName;
        }
        $faqs->save();
        session()->flash('message', 'Faq has been created successfully!');
    }
    public function render()
    {
        return view('livewire.admin.add-faq-component')->layout('layouts.base');
    }
}
