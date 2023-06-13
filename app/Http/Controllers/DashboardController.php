<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Inertia\Inertia;

class Dashboard extends Controller
{
    public function show(Event $event)
    {
        return Inertia::render('Doctor/Show', [
            'event' => $event->only(
                'id',
                'title',
                'start_date',
                'description'
            ),
        ]);
        // return Inertia::render('Client/Show', [
        //     'event' => $event->only(
        //         'id',
        //         'title',
        //         'start_date',
        //         'description'
        //     ),
        // ]);
        // return Inertia::render('Receptionist/Show', [
        //     'event' => $event->only(
        //         'id',
        //         'title',
        //         'start_date',
        //         'description'
        //     ),
        // ]);
        
    }
}