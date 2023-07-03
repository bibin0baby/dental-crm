<?php

namespace App\Http\Controllers;
Use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
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
        //$user = Auth::user();
        //echo "<pre>";print_r($user);echo "</pre>";
        return Inertia::render('Doctor/DoctorAvailability', [
            'doctor' => Auth::user()->doctor_availability()
                ->with('organization')
                ->orderByName()
                ->filter($request->only('search', 'trashed'))
                ->paginate(10)
                ->withQueryString()
                ->through(fn ($doctor) => [
                    'doctor_id' => $doctor->doctor_id,
                    'break_Day' => $doctor->break_Day,
                    'break_Fromtime' => $doctor->break_Fromtime,
                    'break_Totime' => $doctor->break_Totime,
                    'leave_FromDate' => $doctor->leave_FromDate,
                    'leave_ToDate' => $doctor->leave_ToDate,
                    'availability' => $doctor->availability,
                    'consultation' => $doctor->consultation,               
                ])
        ]);
    }
}
