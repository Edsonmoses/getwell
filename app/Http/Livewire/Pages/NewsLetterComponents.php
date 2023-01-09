<?php

namespace App\Http\Livewire\Pages;

use App\Models\Contacts;
use App\Models\News;
use Livewire\Component;
use Illuminate\Support\Str;

class NewsLetterComponents extends Component
{
    public $email;
    public $slug;
    public $phone;

    public function mount()
    {
        $this->status = 'subscriber';
    }

    public function generateSlug()
    {
        $placeObj = new News();

        $string = preg_replace('/[^A-Za-z0-9\-]/', '-', $this->email); //Removed all Special Character and replace with hyphen
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
    private function resetInputFields()
    {

        $this->email = '';
        $this->slug = '';
    }
    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'email' => 'required',
            'slug' => 'required',
        ]);
    }

    public function addNews()
    {
        $this->validate([
            'email' => 'required',
            'slug' => 'required',
        ]);
        $news = new News();
        $news->email = $this->email;
        $news->slug = $this->slug;
        $news->status = $this->status;
        $news->save();
        session()->flash('message', 'You have successfully subscribed to our mailing list!');

        $this->resetInputFields();
    }


    public function render()
    {
        $contacts = Contacts::where('status', 'published')->orderBy('created_at', 'ASC')->get();
        return view('livewire.pages.news-letter-components', ['contacts' => $contacts]);
    }
}
