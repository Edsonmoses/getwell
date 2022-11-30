<?php

namespace App\Http\Livewire\Admin;

use Carbon\Carbon;
use App\Models\Befores;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;

class AddBeforeComponent extends Component
{
    use WithFileUploads;
    public $title;
    public $slug;
    public $subtitle;
    public $after;
    public $before;

    public function mount()
    {
        $this->status = 'published';
        $this->postedby = Auth::user()->name;
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
                'after' => 'required|mimes:png,jpg,jpeg,webp',
            ]);
        }
        if ($this->before) {
            $this->validateOnly($fields, [
                'before' => 'required|mimes:png,jpg,jpeg,webp',
            ]);
        }
    }

    public function addBefore()
    {
        $this->validate([
            'title' => 'required',
            'slug' => 'required',
            'subtitle' => 'required',
        ]);
        if ($this->after) {
            $this->validate([
                'after' => 'required|mimes:png,jpg,jpeg,webp',
            ]);
        }
        if ($this->before) {
            $this->validate([
                'before' => 'required|mimes:png,jpg,jpeg,webp',
            ]);
        }
        $before = new Befores();
        $before->title = $this->title;
        $before->slug = $this->slug;
        $before->subtitle = $this->subtitle;
        $before->status = $this->status;
        $before->postedby = $this->postedby;
        $imageName = Carbon::now()->timestamp . '.' . $this->after->extension();
        $this->after->storeAs('before', $imageName);
        $before->after = $imageName;
        $beforeName = Carbon::now()->timestamp . '.' . $this->before->extension();
        $this->before->storeAs('before', $beforeName);
        $before->before = $beforeName;
        $before->save();
        session()->flash('message', 'Before & After has been created successfully!');
    }
    public function render()
    {
        return view('livewire.admin.add-before-component')->layout('layouts.base');
    }
}
