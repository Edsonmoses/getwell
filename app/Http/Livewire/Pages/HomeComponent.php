<?php

namespace App\Http\Livewire\Pages;

use App\Models\Faqs;
use App\Models\Hero;
use App\Models\News;
use App\Models\Blogs;
use App\Models\Teams;
use App\Models\Aboutus;
use App\Models\Befores;
use Livewire\Component;
use App\Models\Features;
use App\Models\Funfacts;
use App\Models\Galleries;
use App\Models\Departments;
use Illuminate\Support\Str;
use App\Models\Appointments;
use App\Models\Contactforms;
use App\Models\Testimonials;
use App\Models\DepartmentList;
use App\Models\Logos;

class HomeComponent extends Component
{
    public $uname;
    public $slug;
    public $uemail;
    public $unumber;
    public $udate;
    public $udepartment;
    public $udoctor;
    public $umsg;

    public function mount()
    {
        $this->status = 'open';
    }

    public function generateSlug()
    {
        $placeObj = new Appointments();

        $string = preg_replace('/[^A-Za-z0-9\-]/', '-', $this->uname); //Removed all Special Character and replace with hyphen
        $final_slug = preg_replace('/-+/', '-', $string); //Removed double hyphen
        $appointmentNameURL = strtolower($final_slug);

        $this->slug = Str::slug($appointmentNameURL);
        //Check if this Slug already exists 
        $checkSlug = $placeObj->whereSlug($appointmentNameURL)->exists();

        if ($checkSlug) {
            //Slug already exists.

            //Add numerical prefix at the end. Starting with 1
            $numericalPrefix = 1;

            while (1) {
                //Check if Slug with final prefix exists.

                $newSlug = $appointmentNameURL . "-" . $numericalPrefix++; //new Slug with incremented Slug Numerical Prefix
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
            $this->slug = $appointmentNameURL;
        }
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'uname' => 'required',
            'slug' => 'required',
            'uemail' => 'required',
            'unumber' => 'required',
            'udate' => 'required',
            'udepartment' => 'required',
            'udoctor' => 'required',
            'umsg' => 'required',
        ]);
    }

    public function addAppointment()
    {
        $this->validate([
            'uname' => 'required',
            'slug' => 'required',
            'uemail' => 'required',
            'unumber' => 'required',
            'udate' => 'required',
            'udepartment' => 'required',
            'udoctor' => 'required',
            'umsg' => 'required',
        ]);
        $appointment = new Appointments();
        $appointment->uname = $this->uname;
        $appointment->slug = $this->slug;
        $appointment->uemail = $this->uemail;
        $appointment->unumber = $this->unumber;
        $appointment->udate = $this->udate;
        $appointment->udepartment = $this->udepartment;
        $appointment->udoctor = $this->udoctor;
        $appointment->umsg = $this->umsg;
        $appointment->status = $this->status;
        $appointment->save();
        session()->flash('message', 'Appointment has been created successfully!');
    }


    public function render()
    {
        $sliders = Hero::where('status', 'published')->orderBy('created_at', 'DESC')->get();
        $features = Features::where('status', 'published')->orderBy('created_at', 'ASC')->get();
        $aboutus = Aboutus::where('status', 'published')->orderBy('created_at', 'ASC')->get();
        $departments = Departments::where('status', 'published')->orderBy('created_at', 'ASC')->get();
        $departmentslists = DepartmentList::orderBy('name', 'ASC')->get();
        $udoctors = Teams::where('status', 'published')->orderBy('created_at', 'ASC')->get();
        $galleries = Galleries::where('status', 'published')->orderBy('created_at', 'ASC')->get();
        $before = Befores::where('status', 'published')->orderBy('created_at', 'ASC')->get();
        $testimonials = Testimonials::where('status', 'published')->orderBy('created_at', 'ASC')->get();
        $funfacts = Funfacts::where('status', 'published')->orderBy('created_at', 'ASC')->get();
        $faqs = Faqs::where('status', 'published')->orderBy('created_at', 'ASC')->get();
        $news = News::where('status', 'published')->orderBy('created_at', 'ASC')->get();
        $blogs = Blogs::where('status', 'published')->orderBy('created_at', 'ASC')->take(3)->get();
        $logos = Logos::where('status', 'published')->orderBy('created_at', 'ASC')->get();
        return view('livewire.pages.home-component', [
            'sliders' => $sliders, 'features' => $features, 'aboutus' => $aboutus, 'departments' => $departments, 'departmentslists' => $departmentslists,
            'udoctors' => $udoctors, 'galleries' => $galleries, 'before' => $before, 'testimonials' => $testimonials, 'funfacts' => $funfacts, 'faqs' => $faqs,
            'news' => $news, 'blogs' => $blogs, 'logos' => $logos
        ]);
    }
}
