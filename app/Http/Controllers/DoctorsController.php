<?php

namespace App\Http\Controllers;
use App\Models\Contact;
use App\Models\Doctor;
Use Illuminate\Support\Facades\Auth;
//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\doctor_availability;

class DoctorsController extends Controller
{
    public function index(Request $request)
    {       
        return Inertia::render('Doctor/Index', [
            'filters' => Request::all('search', 'trashed'),
            'users' => Auth::user()->account->users()
            ->orderByName()
            ->filter(Request::only('search', 'role', 'trashed'))
            ->join('permissions', 'users.id', '=', 'permissions.id')
            ->join('roles', 'permissions.id', '=', 'roles.id')
            ->where('roles.name', 'standard')
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

    // public function doctorAvailability(Request $request)
    // {
    //     $user = Auth::user();
    //     //echo "<pre>";print_r($user);echo "</pre>";

    //     $doc_availability = DB::table('doctor_availability')
    //         ->select('*')
    //         ->where('doctor_id', $user->id)
    //         ->get();
    //     return Inertia::render('Doctor/DoctorAvailability', [
    //         'doctor' => $doc_availability
    //     ]);
    // }
    public function create()
    {
        return Inertia::render('Doctor/Create');
    }

    public function store()
    {
        Request::validate([
            'first_name' => ['required', 'max:50'],
            'last_name' => ['required', 'max:50'],
            'email' => ['required', 'max:50', 'email', Rule::unique('users')],
            'password' => ['nullable'],
            'owner' => ['required', 'boolean'],
            'role' => ['required', 'boolean'],
            'photo' => ['nullable', 'image'],
        ]);

        $created_user = Auth::user()->account->users()->create([
            'first_name' => Request::get('first_name'),
            'last_name' => Request::get('last_name'),
            'email' => Request::get('email'),
            'password' => Request::get('password'),
            'owner' => Request::get('owner'),
            'photo_path' => Request::file('photo') ? Request::file('photo')->store('users') : null,
        ]);
        $created_user->assignRole(Request::get('role'));

        return Redirect::route('users')->with('success', 'Doctor created.');
    }

    public function edit(User $user)
    {
        return Inertia::render('Doctor/Edit', [
            'user' => [
                'id' => $user->id,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'email' => $user->email,
                'owner' => $user->owner,
                'role'  => $user->roles->pluck('name')[0],
                'role_name'  => ($user->roles->pluck('name')[0] == 'standard') ? 'Receptionist' : ucfirst($user->roles->pluck('name')[0]),
                'photo' => $user->photo_path ? URL::route('image', ['path' => $user->photo_path, 'w' => 60, 'h' => 60, 'fit' => 'crop']) : null,
                'deleted_at' => $user->deleted_at,
            ],
        ]);
    }

    public function update(User $user)
    {
        if (App::environment('demo') && $user->isDemoUser()) {
            return Redirect::back()->with('error', 'Updating the demo doctor is not allowed.');
        }

        Request::validate([
            'first_name' => ['required', 'max:50'],
            'last_name' => ['required', 'max:50'],
            'email' => ['required', 'max:50', 'email', Rule::unique('users')->ignore($user->id)],
            'password' => ['nullable'],
            'owner' => ['required', 'boolean'],
            'role' => ['required', 'max:15'],
            'photo' => ['nullable', 'image'],
        ]);

        $user->update(Request::only('first_name', 'last_name', 'email', 'owner'));

        if (Request::file('photo')) {
            $user->update(['photo_path' => Request::file('photo')->store('users')]);
        }

        if (Request::get('password')) {
            $user->update(['password' => Request::get('password')]);
        }

        if (Request::get('role')) {
            $created_user->assignRole(Request::get('role'));
        }


        return Redirect::back()->with('success', 'Doctor updated.');
    }

    public function destroy(User $user)
    {
        if (App::environment('demo') && $user->isDemoUser()) {
            return Redirect::back()->with('error', 'Deleting the demo user is not allowed.');
        }

        $user->delete();

        return Redirect::back()->with('success', 'Doctor deleted.');
    }

    public function restore(User $user)
    {
        $user->restore();

        return Redirect::back()->with('success', 'Doctor restored.');
    }
}

