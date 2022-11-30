<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class AddCategoryComponent extends Component
{
    public $name;
    public $slug;

    public function mount()
    {
        $this->status = 'published';
        $this->postedby = Auth::user()->name;
    }

    public function generateSlug()
    {
        $placeObj = new Category();

        $string = preg_replace('/[^A-Za-z0-9\-]/', '-', $this->name); //Removed all Special Character and replace with hyphen
        $final_slug = preg_replace('/-+/', '-', $string); //Removed double hyphen
        $categoryNameURL = strtolower($final_slug);

        $this->slug = Str::slug($categoryNameURL);
        //Check if this Slug already exists 
        $checkSlug = $placeObj->whereSlug($categoryNameURL)->exists();

        if ($checkSlug) {
            //Slug already exists.

            //Add numerical prefix at the end. Starting with 1
            $numericalPrefix = 1;

            while (1) {
                //Check if Slug with final prefix exists.

                $newSlug = now()  . "-" . $categoryNameURL . "-" . $numericalPrefix++; //new Slug with incremented Slug Numerical Prefix
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
            $this->slug = $categoryNameURL;
        }
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'required',
            'slug' => 'required',
        ]);
    }

    public function addCategory()
    {
        $this->validate([
            'name' => 'required',
            'slug' => 'required',
        ]);
        $category = new Category();
        $category->name = $this->name;
        $category->slug = $this->slug;
        $category->status = $this->status;
        $category->postedby = $this->postedby;
        $category->save();
        session()->flash('message', 'Category us has been created successfully!');
    }
    public function render()
    {
        return view('livewire.admin.add-category-component')->layout('layouts.base');
    }
}
