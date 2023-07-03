<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class ClientsController extends Controller
{
    public function index(Request $request, $doc_id)
    {
        return Inertia::render('Clients/Index');
    }

    public function calendar_appointments()
    {
        $events = array(
            
        );
        return $events;
    }
}
