<?php

namespace App\Http\Livewire\Admin;

use Carbon\Carbon;
use App\Models\Logos;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class EditLogosComponent extends Component
{
    use WithFileUploads;
    public $name;
    public $slug;
    public $logo;
    public $newlogo;

    public function mount($slug)
    {
        $this->logos_slug = $slug;
        $logos = Logos::where('slug', $slug)->first();
        $this->logos_id = $logos->id;
        $this->name = $logos->name;
        $this->slug = $logos->slug;
        $this->logo = $logos->logo;
        $this->postedby = $logos->postedby;
        $this->status = $logos->status;
        $this->status = 'published';
    }

    public function generateSlug()
    {
        $placeObj = new Logos();

        $string = preg_replace('/[^A-Za-z0-9\-]/', '-', $this->name); //Removed all Special Character and replace with hyphen
        $final_slug = preg_replace('/-+/', '-', $string); //Removed double hyphen
        $logosNameURL = strtolower($final_slug);

        $this->slug = Str::slug($logosNameURL);
        //Check if this Slug already exists 
        $checkSlug = $placeObj->whereSlug($logosNameURL)->exists();

        if ($checkSlug) {
            //Slug already exists.

            //Add numerical prefix at the end. Starting with 1
            $numericalPrefix = 1;

            while (1) {
                //Check if Slug with final prefix exists.

                $newSlug = now()  . "-" . $logosNameURL . "-" . $numericalPrefix++; //new Slug with incremented Slug Numerical Prefix
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
            $this->slug = $logosNameURL;
        }
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'required',
            'slug' => 'required',
        ]);
        if ($this->newlogo) {
            $this->validateOnly($fields, [
                'newlogo' => 'required|mimes:png,jpg,jpeg,webp,svg',
            ]);
        }
    }

    public function updateLogos()
    {
        $this->validate([
            'name' => 'required',
            'slug' => 'required',
        ]);
        if ($this->newlogo) {
            $this->validate([
                'newlogo' => 'required|mimes:png,jpg,jpeg,webp,svg',
            ]);
        }
        $logos = Logos::find($this->logos_id);
        $logos->name = $this->name;
        $logos->slug = $this->slug;;
        $logos->status = $this->status;
        $logos->postedby = $this->postedby;
        if ($this->newlogo) {
            $imageName = Carbon::now()->timestamp . '.' . $this->newlogo->extension();
            $this->newlogo->storeAs('logos', $imageName);
            $logos->logo = $imageName;
        }
        $logos->save();
        session()->flash('message', 'Logo has been updated successfully!');
    }
    public function render()
    {
        return view('livewire.admin.edit-logos-component')->layout('layouts.base');
    }
}
