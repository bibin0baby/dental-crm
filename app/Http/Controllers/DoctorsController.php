<?php

namespace App\Http\Controllers;
Use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DoctorsController extends Controller
{
    public function index()
    {
       // return Inertia::render('Doctor/Index');
        return Inertia::render('Doctor/Index', [
            'doctor' => Auth::user()->account->Doctors()
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
