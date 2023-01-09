<?php

namespace App\Http\Livewire\Admin;

use Carbon\Carbon;
use App\Models\Blogs;
use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class EditBlogComponent extends Component
{
    use WithFileUploads;
    public $title;
    public $slug;
    public $desc;
    public $tags;
    public $image;
    public $newimage;
    public $toptitle;
    public $topicon;
    public $topsubtitle;
    public $category_id;

    public function mount($slug)
    {
        $this->blog_slug = $slug;
        $blog = Blogs::where('slug', $slug)->first();
        $this->blog_id = $blog->id;
        $this->title = $blog->title;
        $this->slug = $blog->slug;
        $this->desc = $blog->desc;
        $this->image = $blog->image;
        $this->toptitle = $blog->toptitle;
        $this->category_id = $blog->category_id;
        $this->topsubtitle = $blog->topsubtitle;
        $this->designation = $blog->designation;
        $this->postedby = $blog->postedby;
        $this->status = $blog->status;
        $this->status = 'published';
    }

    public function generateSlug()
    {
        $placeObj = new Blogs();

        $string = preg_replace('/[^A-Za-z0-9\-]/', '-', $this->title); //Removed all Special Character and replace with hyphen
        $final_slug = preg_replace('/-+/', '-', $string); //Removed double hyphen
        $blogNameURL = strtolower($final_slug);

        $this->slug = Str::slug($blogNameURL);
        //Check if this Slug already exists 
        $checkSlug = $placeObj->whereSlug($blogNameURL)->exists();

        if ($checkSlug) {
            //Slug already exists.

            //Add numerical prefix at the end. Starting with 1
            $numericalPrefix = 1;

            while (1) {
                //Check if Slug with final prefix exists.

                $newSlug = now()  . "-" . $blogNameURL . "-" . $numericalPrefix++; //new Slug with incremented Slug Numerical Prefix
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
            $this->slug = $blogNameURL;
        }
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'title' => 'required',
            'slug' => 'required',
            'desc' => 'required',
            'tags' => 'required',
        ]);
        if ($this->newimage) {
            $this->validateOnly($fields, [
                'newimage' => 'required|mimes:png,jpg,jpeg,webp',
            ]);
        }
    }

    public function addblog()
    {
        $this->validate([
            'title' => 'required',
            'slug' => 'required',
            'desc' => 'required',
            'tags' => 'required',
        ]);
        if ($this->newimage) {
            $this->validate([
                'newimage' => 'required|mimes:png,jpg,jpeg,webp',
            ]);
        }
        $blog = Blogs::find($this->blog_id);
        $blog->title = $this->title;
        $blog->slug = $this->slug;
        $blog->desc = $this->desc;
        $blog->tags = $this->tags;
        $blog->desc = $this->desc;
        $blog->toptitle = $this->toptitle;
        $blog->topicon = $this->topicon;
        $blog->topsubtitle = $this->topsubtitle;
        $blog->category_id = $this->category_id;
        $blog->status = $this->status;
        $blog->postedby = $this->postedby;
        if ($this->newimage) {
            $imageName = Carbon::now()->timestamp . '.' . $this->newimage->extension();
            $this->newimage->storeAs('blogs', $imageName);
            $blog->image = $imageName;
        }
        $blog->save();
        session()->flash('message', 'Post has been updated successfully!');
    }
    public function render()
    {
        $categories = Category::all();
        return view('livewire.admin.edit-blog-component', ['categories' => $categories])->layout('layouts.base');
    }
}
