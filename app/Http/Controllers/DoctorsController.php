<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class DoctorsController extends Controller
{
    public function index()
    {
       // return Inertia::render('Doctor/Index');
        return Inertia::render('Doctor/Index', [
            'contact' => [
                'doctor_id' => $contact->doctor_id,
                'break_Day' => $contact->break_Day,
                'break_Fromtime' => $contact->break_Fromtime,
                'break_Totime' => $contact->break_Totime,
                'leave_FromDate' => $contact->leave_FromDate,
                'leave_ToDate' => $contact->leave_ToDate,
                'availability' => $contact->availability,
                'consultation' => $contact->consultation,               
            ]
        ]);
    }
}
