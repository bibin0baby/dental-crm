<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Consultation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class ConsultationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Consultations/Index', [
            'filters' => Request::all('search', 'trashed'),
            'appointments' => Auth::user()->account->appointments()
            ->with(['contact', 'user']) // Include the 'user' relationship to fetch doctor details
            ->orderByName()
            ->filter(Request::only('search', 'trashed'))
            ->paginate(10)
            ->withQueryString()
            ->through(function ($appointment) {
                return [
                    'id' => $appointment->id,
                    'title' => $appointment->title,
                    'description' => $appointment->description,
                    'scheduled_at' => $appointment->scheduled_at,
                    'duration' => $appointment->duration,
                    'photo_path' => $appointment->photo_path,
                    'doctor_name' => $appointment->user ? $appointment->user->name : null, // Fetch the doctor's name
                    'contact' => $appointment->contact ? $appointment->contact->only('name') : null,
                ];
            }),
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      
        return Inertia::render('Consultations/Create', [
            'contacts' => Auth::user()->account
                ->contacts()
                ->orderBy('name')
                ->get()
                ->map
                ->only('id', 'name'),
                 'users' => Auth::user()->account
                ->users()
                ->orderBy('name')
                ->get()
                ->map
                ->only('id', 'name'),
                // ->where('id', $userId)->value('column_name');
                
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        Auth::user()->account->consltations()->create(
           
        );

        return Redirect::route('consltations')->with('success', 'Cosultation saved  successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function show(Appointment $appointment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function edit(Appointment $appointment)
    {
        return Inertia::render('Consultations/Edit', [
            'appointment' => [
                'id' => $appointment->id,
                'title' => $appointment->title,
                'description' => $appointment->description,
                'scheduled_at' => $appointment->scheduled_at,
                'duration' => $appointment->duration,
                'photo_path' => $appointment->photo_path,
                'contact_id' => $appointment->contact_id,
                'contact' => $appointment->contact ? $appointment->contact->only('name') : null,
                'account_id'=> Auth::user()->id,
            ],
            'contacts' => Auth::user()->account->contacts()
                ->orderBy('name')
                ->get()
                ->map
                ->only('id', 'name'),
                'users' => Auth::user()->account->users()
                ->orderBy('name')
                ->get()
                ->map
                ->only('id', 'name'),
                'doctor_name' => Auth::user()->first_name,

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Consultation $consultation)
    {
        Auth::user()->account->consultations ()->create(
            Request::validate([
              
                // 'diagnosis' => ['required', 'max:500'],
                // 'prescription' => ['nullable', 'max:500'],               
                // 'doctor_id' => ['required', Rule::exists('users', 'id')->where(function ($query) {
                //     $query->where('account_id', Auth::user()->account_id);
                // })],
                // 'contact_id' => ['required', Rule::exists('contacts', 'id')->where(function ($query) {
                //     $query->where('account_id', Auth::user()->account_id);
                // })],
               
            ])
        );
        try {
            //Auth::user()->account->availabilitys()->create($request);
        } catch (\Exception $e) {
            return Redirect::back()->withInput()->withErrors(['error' => 'Failed to save cosultation.']);
        }    
        return Redirect::route('consulations')->with('success', 'Cosultation saved  successfully.');

        //return Redirect::back()->with('success', 'Appointment updated.');
    }
    public function restore(Appointment $appointment)
    {
        $appointment->restore();

        return Redirect::back()->with('success', 'appointment restored.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        return Redirect::route('appointments')->with('success', 'Appointment deleted.');
    }
}
