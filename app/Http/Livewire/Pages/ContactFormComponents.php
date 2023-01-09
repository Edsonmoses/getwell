<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Contactforms;

class ContactFormComponents extends Component
{
    public $name;
    public $slug;
    public $email;
    public $subject;
    public $phone;
    public $msg;
    public function generateSlug()
    {
        $placeObj = new Contactforms();

        $string = preg_replace('/[^A-Za-z0-9\-]/', '-', $this->name); //Removed all Special Character and replace with hyphen
        $final_slug = preg_replace('/-+/', '-', $string); //Removed double hyphen
        $cantactNameURL = strtolower($final_slug);

        $this->slug = Str::slug($cantactNameURL);
        //Check if this Slug already exists 
        $checkSlug = $placeObj->whereSlug($cantactNameURL)->exists();

        if ($checkSlug) {
            //Slug already exists.

            //Add numerical prefix at the end. Starting with 1
            $numericalPrefix = 1;

            while (1) {
                //Check if Slug with final prefix exists.

                $newSlug = $cantactNameURL . "-" . $numericalPrefix++; //new Slug with incremented Slug Numerical Prefix
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
            $this->slug = $cantactNameURL;
        }
    }
    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'required',
            'slug' => 'required',
            'email' => 'required',
            'subject' => 'required',
            'phone' => 'required',
            'msg' => 'required',
        ]);
    }
    public function addCantactform()
    {
        $this->validate([
            'name' => 'required',
            'slug' => 'required',
            'email' => 'required',
            'subject' => 'required',
            'phone' => 'required',
            'msg' => 'required',
        ]);
        $cantact = new Contactforms();
        $cantact->name = $this->name;
        $cantact->slug = $this->slug;
        $cantact->email = $this->email;
        $cantact->subject = $this->subject;
        $cantact->phone = $this->phone;
        $cantact->msg = $this->msg;
        $cantact->save();
        session()->flash('message', 'Cantact has been created successfully!');
        $this->resetInputFields();
    }
    private function resetInputFields()
    {

        $this->name = '';
        $this->slug = '';
        $this->email = '';
        $this->subject = '';
        $this->phone = '';
        $this->msg = '';
    }
    public function render()
    {
        return view('livewire.pages.contact-form-components');
    }
}
