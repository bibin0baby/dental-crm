<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\AvailabilitysController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ImagesController;
use App\Http\Controllers\OrganizationsController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\DoctorsController;
use App\Http\Controllers\ReceptionistsController;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\AppointmentsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Auth

Route::get('login', [AuthenticatedSessionController::class, 'create'])
    ->name('login')
    ->middleware('guest');

Route::post('login', [AuthenticatedSessionController::class, 'store'])
    ->name('login.store')
    ->middleware('guest');

Route::delete('logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');

// Dashboard

Route::get('/', [DashboardController::class, 'index'])
    ->name('dashboard')
    ->middleware('auth');

// Users

Route::get('users', [UsersController::class, 'index'])
    ->name('users')
    ->middleware('auth');

Route::get('users/create', [UsersController::class, 'create'])
    ->name('users.create')
    ->middleware('auth');

Route::post('users', [UsersController::class, 'store'])
    ->name('users.store')
    ->middleware('auth');

Route::get('users/{user}/edit', [UsersController::class, 'edit'])
    ->name('users.edit')
    ->middleware('auth');

Route::put('users/{user}', [UsersController::class, 'update'])
    ->name('users.update')
    ->middleware('auth');

Route::delete('users/{user}', [UsersController::class, 'destroy'])
    ->name('users.destroy')
    ->middleware('auth');

Route::put('users/{user}/restore', [UsersController::class, 'restore'])
    ->name('users.restore')
    ->middleware('auth');

// Organizations

Route::get('organizations', [OrganizationsController::class, 'index'])
    ->name('organizations')
    ->middleware('auth');

Route::get('organizations/create', [OrganizationsController::class, 'create'])
    ->name('organizations.create')
    ->middleware('auth');

Route::post('organizations', [OrganizationsController::class, 'store'])
    ->name('organizations.store')
    ->middleware('auth');

Route::get('organizations/{organization}/edit', [OrganizationsController::class, 'edit'])
    ->name('organizations.edit')
    ->middleware('auth');

Route::put('organizations/{organization}', [OrganizationsController::class, 'update'])
    ->name('organizations.update')
    ->middleware('auth');

Route::delete('organizations/{organization}', [OrganizationsController::class, 'destroy'])
    ->name('organizations.destroy')
    ->middleware('auth');

Route::put('organizations/{organization}/restore', [OrganizationsController::class, 'restore'])
    ->name('organizations.restore')
    ->middleware('auth');

// Contacts

Route::get('contacts', [ContactsController::class, 'index'])
    ->name('contacts')
    ->middleware('auth');

Route::get('contacts/create', [ContactsController::class, 'create'])
    ->name('contacts.create')
    ->middleware('auth');

Route::post('contacts', [ContactsController::class, 'store'])
    ->name('contacts.store')
    ->middleware('auth');

Route::get('contacts/{contact}/edit', [ContactsController::class, 'edit'])
    ->name('contacts.edit')
    ->middleware('auth');

Route::put('contacts/{contact}', [ContactsController::class, 'update'])
    ->name('contacts.update')
    ->middleware('auth');

Route::delete('contacts/{contact}', [ContactsController::class, 'destroy'])
    ->name('contacts.destroy')
    ->middleware('auth');

Route::put('contacts/{contact}/restore', [ContactsController::class, 'restore'])
    ->name('contacts.restore')
    ->middleware('auth');

// Reports

Route::get('reports', [ReportsController::class, 'index'])
    ->name('reports')
    ->middleware('auth');

// Images

Route::get('/img/{path}', [ImagesController::class, 'show'])
    ->where('path', '.*')
    ->name('image');

// Doctors

Route::group(['middleware' => ['role:admin']], function () {
    Route::get('doctors', [DoctorsController::class, 'index'])
        ->name('doctors')
        ->middleware('auth');

    Route::post('doctors', [DoctorsController::class, 'store'])
        ->name('doctors.store')
        ->middleware('auth');
    
});

Route::group(['middleware' => ['role:admin|doctor']], function () {
    Route::get('doctoravailability', [DoctorsController::class, 'doctoravailability'])
    ->name('doctors.doctoravailability')
    ->middleware('auth');
});

// Receptionist

Route::get('receptionist', [ReceptionistsController::class, 'index'])
    ->name('receptionist')
    ->middleware('auth');

// Client

Route::get('client/{doc_id}', [ClientsController::class, 'index'])
    ->name('client')
    ->middleware('guest');

Route::post('client', [ClientsController::class, 'store'])
    ->name('client.store')
    ->middleware('guest');

Route::get('calendar_appointments', [ClientsController::class, 'calendar_appointments'])
        ->name('calendar-appointments')
        ->middleware('guest');
//appointments

Route::get('appointments', [AppointmentsController::class, 'index'])
    ->name('appointments')
    ->middleware('auth');

Route::get('appointments/create', [AppointmentsController::class, 'create'])
    ->name('appointments.create')
    ->middleware('auth');

Route::post('appointments', [AppointmentsController::class, 'store'])
    ->name('appointments.store')
    ->middleware('auth');
    
Route::get('appointments/{appointment}/edit', [AppointmentsController::class, 'edit'])
    ->name('appointments.edit')
    ->middleware('auth');

<<<<<<< HEAD
Route::put('appointments/{appointment}', [AppointmentsController::class, 'update'])
    ->name('appointments.update')
    ->middleware('auth');

Route::delete('appointments/{appointment}', [AppointmentsController::class, 'destroy'])
    ->name('appointments.destroy')
=======
    //Availability
    
 Route::get('availabilitys', [AvailabilitysController::class, 'index'])
    ->name('availabilitys')
    ->middleware('auth');

Route::get('availabilitys/create', [AvailabilitysController::class, 'create'])
    ->name('availabilitys.create')
    ->middleware('auth');

Route::post('availabilitys', [AvailabilitysController::class, 'store'])
    ->name('availabilitys.store')
    ->middleware('auth');

Route::get('availabilitys/{availabilitys}/edit', [AvailabilitysController::class, 'edit'])
    ->name('availabilitys.edit')
    ->middleware('auth');

Route::put('availabilitys/{availabilitys}', [AvailabilitysController::class, 'update'])
    ->name('availabilitys.update')
    ->middleware('auth');

Route::delete('availabilitys/{availabilitys}', [AvailabilitysController::class, 'destroy'])
    ->name('availabilitys.destroy')
    ->middleware('auth');

Route::put('availabilitys/{availabilitys}/restore', [AvailabilitysController::class, 'restore'])
    ->name('availabilitys.restore')
>>>>>>> 55ba8501d2c9f9eea793fecca8f0b8f44c366bd8
    ->middleware('auth');
