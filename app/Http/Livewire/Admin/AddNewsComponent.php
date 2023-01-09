<?php

namespace App\Http\Livewire\Admin;

use App\Models\News;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class AddNewsComponent extends Component
{
    use WithFileUploads;
    public $title;
    public $slug;
    public $subtitle;
    public $email;

    public function mount()
    {
        $this->status = 'published';
    }

    public function generateSlug()
    {
        $placeObj = new News();

        $string = preg_replace('/[^A-Za-z0-9\-]/', '-', $this->title); //Removed all Special Character and replace with hyphen
        $final_slug = preg_replace('/-+/', '-', $string); //Removed double hyphen
        $newsNameURL = strtolower($final_slug);

        $this->slug = Str::slug($newsNameURL);
        //Check if this Slug already exists 
        $checkSlug = $placeObj->whereSlug($newsNameURL)->exists();

        if ($checkSlug) {
            //Slug already exists.

            //Add numerical prefix at the end. Starting with 1
            $numericalPrefix = 1;

            while (1) {
                //Check if Slug with final prefix exists.

                $newSlug = now()  . "-" . $newsNameURL . "-" . $numericalPrefix++; //new Slug with incremented Slug Numerical Prefix
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
            $this->slug = $newsNameURL;
        }
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'title' => 'required',
            'slug' => 'required',
            'subtitle' => 'required',
        ]);
    }

    public function addNews()
    {
        $this->validate([
            'title' => 'required',
            'slug' => 'required',
            'subtitle' => 'required',
        ]);
        $news = new News();
        $news->title = $this->title;
        $news->slug = $this->slug;
        $news->subtitle = $this->subtitle;
        $news->email = $this->email;
        $news->status = $this->status;
        $news->save();
        session()->flash('message', 'news us has been created successfully!');
    }
    public function render()
    {
        return view('livewire.admin.add-news-component')->layout('layouts.base');
    }
}
