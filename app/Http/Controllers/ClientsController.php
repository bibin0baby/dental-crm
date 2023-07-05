<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use DateTime;

use App\Models\Contact;
use App\Models\Appointment;

class ClientsController extends Controller
{
    public function index(Request $request, $doc_id)
    {
        $appointments = DB::table('appointments')
            ->select('*')
            ->where('doctor_id', $doc_id)
            ->where('scheduled_at > ', new Datetime())
            ->get();
        return Inertia::render('Clients/Index', [
            'appointments' => $appointments,
            'doctor_id' => $doc_id,
        ]);
    }

    public function calendar_appointments()
    {
        $events = array(

        );
        return $events;
    }

    public function store(Request $request): RedirectResponse
    {
        //print_r($request->input('email'));exit;
        $start_datetime = new Datetime($request->input('appointments_dt_start'));
        $end_datetime = new Datetime($request->input('appointments_dt_end'));
        $duration = new Datetime($request->input('duration'));
        if($end_datetime != '') {
            $duration = $start_datetime->diff($end_datetime);
        }
        $request->validate([
            'first_name' => ['required', 'max:50'],
            'last_name' => ['required', 'max:50'],
            'email' => ['nullable', 'max:50', 'email'],
            'phone' => ['nullable', 'max:50'],
            'address' => ['nullable', 'max:150'],
            'city' => ['nullable', 'max:50'],
            'region' => ['nullable', 'max:50'],
            'country' => ['nullable', 'max:2'],
            'postal_code' => ['nullable', 'max:25'],
            'appointments_dt_start' => ['required'],
        ]);
        $contact = Contact::updateOrCreate(
            ['email' => $request->input('email'), 'phone' => $request->input('phone')],
            [
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'account_id' => 1,
                'phone' => $request->input('phone'),
                'address' => $request->input('address'),
                'city' => $request->input('city'),
                'region' => $request->input('region'),
                'country' => $request->input('country'),
                'postal_code' => $request->input('postal_code'),
            ]
        );
        $appointment = Appointment::updateOrCreate(
            ['scheduled_at' => $start_datetime->format('Y-m-d H:i:s')],
            [
                'account_id' => 1,
                'doctor_id' => $request->input('doctor_id'),
                'contact_id' => $contact->id,
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'duration' => $duration->format('%H:%I:%S'),
            ]
        );

        return redirect()->route('client.index')
        ->with('message', 'Post created successfully.');
    }
}
