<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Appointments;

class ClosedAppointmentComponent extends Component
{
    public $uname;
    public $slug;
    public $uemail;
    public $unumber;
    public $udate;
    public $udepartment;
    public $udoctor;
    public $umsg;
    public $status;
    public $appointment_id;
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
    public function edit($id)

    {

        $appointment = Appointments::findOrFail($id);
        $this->appointment_id = $id;
        $this->uname = $appointment->uname;
        $this->slug = $appointment->slug;
        $this->uemail = $appointment->uemail;
        $this->unumber = $appointment->unumber;
        $this->udate = $appointment->udate;
        $this->udepartment = $appointment->udepartment;
        $this->udoctor = $appointment->udoctor;
        $this->umsg = $appointment->umsg;
        $this->status = $appointment->status;
    }
    public function closed($id)
    {
        $closedapp = Appointments::find($id);
        $closedapp->status = 'closed';
        $closedapp->save();
        session()->flash('message', 'Appointment has been Placed successfully!');
    }
    public function render()
    {
        $closedappointments = Appointments::where('status', 'closed')->orderBy('created_at', 'desc')->get();
        return view('livewire.admin.closed-appointment-component', ['closedappointments' => $closedappointments])->layout('layouts.base');
    }
}
