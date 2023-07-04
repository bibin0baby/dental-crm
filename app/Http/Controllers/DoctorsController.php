<?php

namespace App\Http\Controllers;
Use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Illuminate\Validation\Rule;
use App\Models\User;

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
            'filters' => $request->all('search', 'trashed'),
            'doctor' => Auth::user()->account->users()
                ->orderByName()
                ->filter($request->only('search', 'trashed'))
                ->join('permissions', 'users.id', '=', 'permissions.id')
                  ->join('roles', 'permissions.id', '=', 'roles.id')
                  ->where('roles.name', 'doctor')
                //->where('roles.name', 'doctor')
                // ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                // ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
                // ->join('model_has_permissions', 'users.id', '=', 'model_has_permissions.model_id')
                // ->join('permissions', 'model_has_permissions.permission_id', '=', 'permissions.id')
                // ->where('roles.name', 'standard')
                ->paginate(10)
                ->withQueryString()
                ->through(fn ($doctor) => [
                    'id' => $doctor->id,
                    'name' => $doctor->name,
                    'phone' => $doctor->phone,
                    'city' => $doctor->city,
                    'deleted_at' => $doctor->deleted_at,
                    'owner' => $doctor->owner,
                    'role' => $doctor->roles,
                    'roles' => 'Doctor',
                   // 'roles'  => ($doctor->roles->pluck('name')[0] == 'doctor') ? 'Doctor' : ucfirst($doctor->roles->pluck('name')[0]),
                    'photo' => $doctor->photo_path ? URL::route('image', ['path' => $doctor->photo_path, 'w' => 40, 'h' => 40, 'fit' => 'crop']) : null,
                    
                    // 'organization' => $doctor->organization ? $doctor->organization->only('name') : null,
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
