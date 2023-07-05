<?php

namespace App\Http\Controllers;
Use Illuminate\Support\Facades\Auth;
//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Illuminate\Validation\Rule;
use App\Models\User;
App\Models\doctor_availability;

class DoctorsController extends Controller
{
    public function index(Request $request)
    {
        // $doctors = user::role('doctor')->get();
        // print_r($doctors);
        // return Inertia::render('Doctor/Index', [
        //     'filters' => $request->all(['search', 'trashed']),            
        //     'doctor' => $doctors
        // ]);
        return Inertia::render('Doctor/Index', [
            'filters' => Request::all('search', 'trashed'),
            'doctors' => Auth::user()->account->users()
            ->orderByName()
            ->filter(Request::only('search', 'role', 'trashed'))
            ->paginate(10)
            ->withQueryString()
            ->transform(fn ($user) => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'owner' => $user->owner,
                'role'  => ($user->roles->pluck('name')[0] == 'standard') ? 'Receptionist' : ucfirst($user->roles->pluck('name')[0]),
                'photo' => $user->photo_path ? URL::route('image', ['path' => $user->photo_path, 'w' => 40, 'h' => 40, 'fit' => 'crop']) : null,
                'deleted_at' => $user->deleted_at,
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

    public function store()
    {
        // print_r("here");
        Request::validate([
            'availabilityDays' => ['required','max:100'],
            'availabilityFrom' => ['required', 'date'],
            'availabilityTo' => ['required','date'],
            'break_Fromtime' => ['required', 'date'],
            'break_Totime' => ['required','date'],
            'leave_FromDate' => ['required', 'date'],
            'leave_ToDate' => ['required', 'date'],
            'ConsultaionTime' => ['required', 'max:100'],
        ]);
        // Auth::user()->account->organizations()->create(
        //     Request::validate([
        // return Redirect::route('doctor_availability')->with('success', 'Organization created.');
       Auth::user()->account->doctor_availability()->create([
            'doctor_id' => Request::get('doctor_id'),
            'availabilityDays' => Request::get('availabilityDays'),
            'availabilityFrom' => Request::get('availabilityFrom'),
            'availabilityTo' => Request::get('availabilityTo'),
            'break_Fromtime' => Request::get('break_Fromtime'),
            'break_Totime' => Request::get('break_Totime'),
            'leave_FromDate' => Request::get('leave_FromDate'),
            'leave_ToDate' => Request::get('leave_ToDate'),
            'consultation' => Request::get('ConsultaionTime'),
        ]);   
        //echo "<pre>";print_r($ScheduleDoctorAvailability);echo "</pre>";    
         return Redirect::route('doctor_availability')->with('success', 'Doctor schedule created.');
    }
}
