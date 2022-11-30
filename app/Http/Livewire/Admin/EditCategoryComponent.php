<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Str;

class EditCategoryComponent extends Component
{
    public $name;
    public $slug;

    public function mount($slug)
    {
        $this->category_slug = $slug;
        $category = Category::where('slug', $slug)->first();
        $this->category_id = $category->id;
        $this->name = $category->name;
        $this->slug = $category->slug;
        $this->postedby = $category->postedby;
        $this->status = $category->status;
        $this->status = 'published';
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
        $category = Category::find($this->category_id);
        $category->name = $this->name;
        $category->slug = $this->slug;
        $category->status = $this->status;
        $category->postedby = $this->postedby;
        $category->save();
        session()->flash('message', 'Category has been updated successfully!');
    }
    public function render()
    {
        return view('livewire.admin.edit-category-component')->layout('layouts.base');
    }
}
