<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use DateTime;

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
            'appointments' => $appointments
        ]);
    }

    public function calendar_appointments()
    {
        $events = array(

        );
        return $events;
    }

    public function store()
    {
        Auth::user()->account->contacts()->create(
            Request::validate([
                'first_name' => ['required', 'max:50'],
                'last_name' => ['required', 'max:50'],
                'organization_id' => ['nullable', Rule::exists('organizations', 'id')->where(function ($query) {
                    $query->where('account_id', Auth::user()->account_id);
                })],
                'email' => ['nullable', 'max:50', 'email'],
                'phone' => ['nullable', 'max:50'],
                'address' => ['nullable', 'max:150'],
                'city' => ['nullable', 'max:50'],
                'region' => ['nullable', 'max:50'],
                'country' => ['nullable', 'max:2'],
                'postal_code' => ['nullable', 'max:25'],
            ])
        );

        return Redirect::route('contacts')->with('success', 'Contact created.');
    }
}
