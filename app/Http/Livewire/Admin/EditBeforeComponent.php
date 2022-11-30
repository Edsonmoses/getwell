<?php

namespace App\Http\Livewire\Admin;

use Carbon\Carbon;
use App\Models\Befores;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class EditBeforeComponent extends Component
{
    use WithFileUploads;
    public $title;
    public $slug;
    public $subtitle;
    public $after;
    public $before;
    public $newafter;
    public $newbefore;

    public function mount($slug)
    {
        $this->before_slug = $slug;
        $before = Befores::where('slug', $slug)->first();
        $this->before_id = $before->id;
        $this->title = $before->title;
        $this->slug = $before->slug;
        $this->subtitle = $before->subtitle;
        $this->after = $before->after;
        $this->before = $before->before;
        $this->postedby = $before->postedby;
        $this->status = $before->status;
        $this->status = 'published';
    }

    public function generateSlug()
    {
        $placeObj = new Befores();

        $string = preg_replace('/[^A-Za-z0-9\-]/', '-', $this->title); //Removed all Special Character and replace with hyphen
        $final_slug = preg_replace('/-+/', '-', $string); //Removed double hyphen
        $beforeNameURL = strtolower($final_slug);

        $this->slug = Str::slug($beforeNameURL);
        //Check if this Slug already exists 
        $checkSlug = $placeObj->whereSlug($beforeNameURL)->exists();

        if ($checkSlug) {
            //Slug already exists.

            //Add numerical prefix at the end. Starting with 1
            $numericalPrefix = 1;

            while (1) {
                //Check if Slug with final prefix exists.

                $newSlug = now()  . "-" . $beforeNameURL . "-" . $numericalPrefix++; //new Slug with incremented Slug Numerical Prefix
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
            $this->slug = $beforeNameURL;
        }
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'title' => 'required',
            'slug' => 'required',
            'subtitle' => 'required',
        ]);
        if ($this->after) {
            $this->validateOnly($fields, [
                'newafter' => 'required|mimes:png,jpg,jpeg,webp',
            ]);
        }
        if ($this->before) {
            $this->validateOnly($fields, [
                'newbefore' => 'required|mimes:png,jpg,jpeg,webp',
            ]);
        }
    }

    public function updateBefore()
    {
        $this->validate([
            'title' => 'required',
            'slug' => 'required',
            'subtitle' => 'required',
        ]);
        if ($this->newafter) {
            $this->validate([
                'newafter' => 'required|mimes:png,jpg,jpeg,webp',
            ]);
        }
        if ($this->newbefore) {
            $this->validate([
                'newbefore' => 'required|mimes:png,jpg,jpeg,webp',
            ]);
        }
        $before = Befores::find($this->before_id);
        $before->title = $this->title;
        $before->slug = $this->slug;
        $before->subtitle = $this->subtitle;
        $before->status = $this->status;
        $before->postedby = $this->postedby;
        if ($this->newafter) {
            $imageName = Carbon::now()->timestamp . '.' . $this->newafter->extension();
            $this->newafter->storeAs('before', $imageName);
            $before->after = $imageName;
        }
        if ($this->newbefore) {
            $beforeName = Carbon::now()->timestamp . '.' . $this->newbefore->extension();
            $this->newbefore->storeAs('before', $beforeName);
            $before->before = $beforeName;
        }
        $before->save();
        session()->flash('message', 'Before & After has been created successfully!');
    }
    public function render()
    {
        return view('livewire.admin.edit-before-component')->layout('layouts.base');
    }
}
