<?php

namespace App\Http\Controllers;

use App\Models\Availability;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class AvailabilitysController extends Controller
{
    public function index()
    {
        return Inertia::render('Availabilitys/Index', [
            'filters' => Request::all('search', 'trashed'),
            'availabilitys' => Auth::user()->account->availabilitys()
                ->with('organization')
                ->orderByName()
                ->filter(Request::only('search', 'trashed'))
                ->paginate(10)
                ->withQueryString()
                ->through(fn ($availabilitys) => [
                    'id' => $availabilitys->id,
                    'availabilityDays' => $availabilitys->availabilityDays,
                    'availabilityFrom' => $availabilitys->availabilityFrom,
                    'availabilityTo' => $availabilitys->availabilityTo,
                    'break_Fromtime' => $availabilitys->break_Fromtime,
                    'break_Totime' => $availabilitys->break_Totime,
                    'leave_FromDate' => $availabilitys->leave_FromDate,
                    'leave_ToDate' => $availabilitys->leave_ToDate,
                    'ConsultaionTime' => $availabilitys->ConsultaionTime,
                    'city' => $availabilitys->city,
                    'deleted_at' => $availabilitys->deleted_at,
                    'organization' => $availabilitys->organization ? $availabilitys->organization->only('name') : null,
                ]),
        ]);
    }

    public function create()
    {
        return Inertia::render('Availabilitys/Create', [
            'organizations' => Auth::user()->account
                ->organizations()
                ->orderBy('name')
                ->get()
                ->map
                ->only('id', 'name'),
        ]);
    }

    
    public function store(Request $request)
    {     

        // Request::validate([
        //     'doctor_id' => ['nullable','integer'],
        //     'availabilityDays' => ['nullable','max:100'],
        //     'availabilityFrom' => ['nullable', 'date_format:H:i'],
        //     'availabilityTo' => ['nullable', 'date_format:H:i'],
        //     'break_Fromtime' => ['nullable', 'date_format:H:i'],
        //     'break_Totime' => ['nullable', 'date_format:H:i'],
        //     'leave_FromDate' => ['nullable', 'date'],
        //     'leave_ToDate' => ['nullable', 'date'],
        //     'ConsultaionTime' => ['nullable', 'max:100'],            
        // ]);
        // Request::validate([
        //     'doctor_id' => ['nullable','max:100'],
        //         'availabilityDays' => ['nullable','max:100'],
        //         'leave_FromDate' => ['nullable', 'date'],
        //         'leave_ToDate' => ['nullable', 'date'],
        //         'ConsultaionTime' => ['nullable', 'max:100'],
        // ]);
        
        // Auth::user()->account->availabilitys()->create([
        //    // Request::validate([
        //         'doctor_id' => ['nullable','integer'],
        //         'availabilityDays' => ['nullable','max:100'],
        //         'availabilityFrom' => ['nullable', 'max:100'],
        //         'availabilityTo' => ['nullable','max:100'],
        //         'break_Fromtime' => ['nullable', 'max:100'],
        //         'break_Totime' => ['nullable','max:100'],
        //         'leave_FromDate' => ['nullable', 'max:100'],
        //         'leave_ToDate' => ['nullable', 'max:100'],
        //         'ConsultaionTime' => ['nullable', 'max:100'],
        //         'organization_id' => ['nullable', Rule::exists('organizations', 'id')->where(function ($query) {
        //             $query->where('account_id', Auth::user()->account_id);
        //         })],
        //    // ])
        // ]);

        // return Redirect::route('availabilitys')->with('success', 'Doctor schedule created.');  
        
        Auth::user()->account->availabilitys()->create(
            Request::validate([
                'availabilityDays' => ['required', 'max:50'],
                'availabilityFrom' => ['required', 'max:50'],
                'organization_id' => ['nullable', Rule::exists('organizations', 'id')->where(function ($query) {
                    $query->where('account_id', Auth::user()->account_id);
                })],
                'availabilityTo' => ['nullable', 'max:50'],
                'break_Fromtime' => ['nullable', 'max:50'],
                'break_Totime' => ['nullable', 'max:150'],
                'leave_FromDate' => ['nullable', 'max:50'],
                'leave_ToDate' => ['nullable', 'max:50'],
                'ConsultaionTime' => ['nullable', 'max:50'],
            ])
        );

        try {
            Auth::user()->account->availabilitys()->create($request);
        } catch (\Exception $e) {
            return Redirect::back()->withInput()->withErrors(['error' => 'Failed to create doctor schedule.']);
        }
    
        return Redirect::route('availabilitys')->with('success', 'Contact test created.');
    }

    public function edit(Availability $availabilitys)
    {
        return Inertia::render('Availabilitys/Edit', [
            'availability' => [
                'id' => $availabilitys->id,
                'availabilityDays' => $availabilitys->availabilityDays,
                'availabilityFrom' => $availabilitys->availabilityFrom,
                'availabilityTo' => $availabilitys->availabilityTo,
                'break_Fromtime' => $availabilitys->break_Fromtime,
                'break_Totime' => $availabilitys->break_Totime,
                'leave_FromDate' => $availabilitys->leave_FromDate,
                'leave_ToDate' => $availabilitys->leave_ToDate,
                'ConsultaionTime' => $availabilitys->ConsultaionTime,
                'doctor_id' => $availabilitys->doctor_id,
                'deleted_at' => $availabilitys->deleted_at,
            ],
            'organizations' => Auth::user()->account->organizations()
                ->orderBy('name')
                ->get()
                ->map
                ->only('id', 'name'),
        ]);
    }

    public function update(Availability $availability)
    {
        $availability->update(
            Request::validate([
                'availabilityDays' => ['required', 'max:100'],
                'availabilityFrom' => ['required', 'max:100'],
                'availabilityTo' => ['required', 'max:100'],
                'break_Fromtime' => ['required', 'max:100'],
                'break_Totime' => ['required', 'max:100'],
                'leave_FromDate' => ['required', 'max:100'],
                'leave_ToDate' => ['required', 'max:100'],
                'ConsultaionTime' => ['required', 'max:100'],
                'organization_id' => [
                    'nullable',
                    Rule::exists('organizations', 'id')->where(fn ($query) => $query->where('account_id', Auth::user()->account_id)),
                ],               
            ])
        );

        return Redirect::back()->with('success', 'Schedule updated.');
    }

    public function destroy(Availability $availability)
    {
        $availability->delete();

        return Redirect::back()->with('success', 'Schedule deleted.');
    }

    public function restore(Availability $availability)
    {
        $availability->restore();

        return Redirect::back()->with('success', 'Schedule restored.');
    }
}
