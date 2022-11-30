<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Contacts;
use Illuminate\Support\Str;

class EditContactComponent extends Component
{
    public $address;
    public $slug;
    public $email;
    public $phone;
    public $facebook;
    public $linkedin;
    public $twitter;
    public $youtube;
    public $tiktok;
    public $whatsapp;

    public function mount($slug)
    {
        $this->contacts_slug = $slug;
        $contacts = Contacts::where('slug', $slug)->first();
        $this->contacts_id = $contacts->id;
        $this->address = $contacts->address;
        $this->slug = $contacts->slug;
        $this->email = $contacts->email;
        $this->phone = $contacts->phone;
        $this->facebook = $contacts->facebook;
        $this->linkedin = $contacts->linkedin;
        $this->twitter = $contacts->twitter;
        $this->youtube = $contacts->youtube;
        $this->tiktok = $contacts->tiktok;
        $this->whatsapp = $contacts->whatsapp;
        $this->postedby = $contacts->postedby;
        $this->status = $contacts->status;
        $this->status = 'published';
    }

    public function generateSlug()
    {
        $placeObj = new Contacts();

        $string = preg_replace('/[^A-Za-z0-9\-]/', '-', $this->address); //Removed all Special Character and replace with hyphen
        $final_slug = preg_replace('/-+/', '-', $string); //Removed double hyphen
        $contactsNameURL = strtolower($final_slug);

        $this->slug = Str::slug($contactsNameURL);
        //Check if this Slug already exists 
        $checkSlug = $placeObj->whereSlug($contactsNameURL)->exists();

        if ($checkSlug) {
            //Slug already exists.

            //Add numerical prefix at the end. Starting with 1
            $numericalPrefix = 1;

            while (1) {
                //Check if Slug with final prefix exists.

                $newSlug = now()  . "-" . $contactsNameURL . "-" . $numericalPrefix++; //new Slug with incremented Slug Numerical Prefix
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
            $this->slug = $contactsNameURL;
        }
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'address' => 'required',
            'slug' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'facebook' => 'required',
            'linkedin' => 'required',
            'twitter' => 'required',
            'youtube' => 'required',
            'tiktok' => 'required',
            'whatsapp' => 'required',
        ]);
    }

    public function updateContacts()
    {
        $this->validate([
            'address' => 'required',
            'slug' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'facebook' => 'required',
            'linkedin' => 'required',
            'twitter' => 'required',
            'youtube' => 'required',
            'tiktok' => 'required',
            'whatsapp' => 'required',
        ]);
        $contacts = Contacts::find($this->contacts_id);
        $contacts->address = $this->address;
        $contacts->slug = $this->slug;
        $contacts->email = $this->email;
        $contacts->phone = $this->phone;
        $contacts->facebook = $this->facebook;
        $contacts->linkedin = $this->linkedin;
        $contacts->twitter = $this->twitter;
        $contacts->youtube = $this->youtube;
        $contacts->tiktok = $this->tiktok;
        $contacts->whatsapp = $this->whatsapp;
        $contacts->status = $this->status;
        $contacts->postedby = $this->postedby;
        $contacts->save();
        session()->flash('message', 'Contact has been updated successfully!');
    }
    public function render()
    {
        return view('livewire.admin.edit-contact-component')->layout('layouts.base');
    }
}
