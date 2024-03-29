<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function organizations()
    {
        return $this->hasMany(Organization::class);
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
    public function availabilitys()
    {
        return $this->hasMany(Availability::class);
    }

    public function doctors()
    {
        return $this->hasMany(Doctor::class);
    }

    public function consultations()
    {
        return $this->hasMany(Consultation::class);
    }
    
}
