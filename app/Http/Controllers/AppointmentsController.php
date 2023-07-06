<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class AppointmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Appointments/Index', [
            'filters' => Request::all('search', 'trashed'),
            'appointments' => Auth::user()->account->appointments()
            ->with('contact')
                ->orderByName()
                ->filter(Request::only('search', 'trashed'))
                ->paginate(10)
                ->withQueryString()
                ->through(fn ($appointment) => [
                    'id' => $appointment->id,
                    'title' => $appointment->title,
                    'description' => $appointment->description,
                    'scheduled_at' => $appointment->scheduled_at,
                    'duration' => $appointment->duration,
                   'photo_path' => $appointment->photo_path,
                  'doctor_id' => $appointment->doctor_id,
                    'contact' => $appointment->contact ? $appointment->contact->only('name') : null,
                ]),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      
        return Inertia::render('Appointments/Create', [
            'contacts' => Auth::user()->account
                ->contacts()
                ->orderBy('name')
                ->get()
                ->map
                ->only('id', 'name'),
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
        
        Auth::user()->account->appointments()->create(
            Request::validate([
              
                'title' => ['required', 'max:50'],
                'description' => ['nullable', 'max:150'],
               
                'scheduled_at' => ['required', 'max:50'],
                'duration' => ['nullable', 'max:50'],
                'photo_path' => ['nullable', 'max:150'],
                'doctor_id' => ['required', 'max:50'],
                'contact_id' => ['required', Rule::exists('contacts', 'id')->where(function ($query) {
                    $query->where('account_id', Auth::user()->account_id);
                })],
               
            ])
        );

        return Redirect::route('appointments')->with('success', 'Appointment Booked.');
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
        return Inertia::render('Appointments/Edit', [
            'appointment' => [
                'id' => $appointment->id,
                'title' => $appointment->title,
                'description' => $appointment->description,
                'scheduled_at' => $appointment->scheduled_at,
                'duration' => $appointment->duration,
                'photo_path' => $appointment->photo_path,
                'doctor_id' => $appointment->doctor_id,
                'contact_id' => $appointment->contact_id,
               
            ],
            'contacts' => Auth::user()->account->contacts()
                ->orderBy('first_name')
                ->get()
                ->map
                ->only('id', 'first_name'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Appointment $appointment)
    {
        $appointment->update(
            Request::validate([
                'title' => ['required', 'max:50'],
                'description' => ['nullable', 'max:50'],
                'contact_id' => [
                    'required',
                    Rule::exists('contacts', 'id')->where(fn ($query) => $query->where('account_id', Auth::user()->account_id)),
                ],
                'scheduled_at' => ['required', 'max:50'],
                'duration' => ['nullable', 'max:50'],
                'photo_path' => ['nullable', 'max:150'],
                'doctor_id' => ['required', 'max:50'],
              
            ])
        );

        return Redirect::back()->with('success', 'Appointment updated.');
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
