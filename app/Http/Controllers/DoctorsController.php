<?php

namespace App\Http\Controllers;
Use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class DoctorsController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Doctor/Index', [
            'filters' => $request->all('search', 'trashed'),
            'doctor' => Auth::user()->account->contacts()
                ->with('organization')
                ->orderByName()
                ->filter($request->only('search', 'trashed'))
                ->paginate(10)
                ->withQueryString()
                ->through(fn ($doctor) => [
                    'id' => $doctor->id,
                    'name' => $doctor->name,
                    'phone' => $doctor->phone,
                    'city' => $doctor->city,
                    'deleted_at' => $doctor->deleted_at,
                    'organization' => $doctor->organization ? $doctor->organization->only('name') : null,
                ]),
        ]);
    }

    public function doctorAvailability(Request $request)
    {
        $user = Auth::user();
        //echo "<pre>";print_r($user);echo "</pre>";

        $doc_availability = DB::table('doctor_availability')
            ->select('*')
            ->where('doctor_id', $user->id)
            ->get();
        return Inertia::render('Doctor/DoctorAvailability', [
            'doctor' => $doc_availability
        ]);
    }
}
