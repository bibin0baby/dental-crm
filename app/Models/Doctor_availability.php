<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Doctor_availability extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $table = 'doctor_availability';
    public function doctoravailabilities()
    {
        return $this->hasMany(Doctor_availability::class);
    }

    public function resolveRouteBinding($value, $field = null)
    {
        return $this->where($field ?? 'id', $value)->withTrashed()->firstOrFail();
    }

    public function doctors()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }

    public function getNameAttribute()
    {
        return $this->first_name.' '.$this->last_name;
    }

    public function scopeOrderByName($query)
    {
        $query->orderBy('last_name')->orderBy('first_name');
    }

    // public function scopeFilter($query, array $filters)
    // {
    //     $query->when($filters['search'] ?? null, function ($query, $search) {
    //         $query->where(function ($query) use ($search) {
    //             $query->where('title', 'like', '%'.$search.'%')
    //                 ->orWhere('description', 'like', '%'.$search.'%')
    //                 ->orWhereHas('doctor', function ($query) use ($search) {
    //                     $query->where('name', 'like', '%'.$search.'%');
    //                 })
    //                 ->orWhereHas('contact', function ($query) use ($search) {
    //                     $query->where('name', 'like', '%'.$search.'%');
    //                 });
    //         });
    //     })->when($filters['trashed'] ?? null, function ($query, $trashed) {
    //         if ($trashed === 'with') {
    //             $query->withTrashed();
    //         } elseif ($trashed === 'only') {
    //             $query->onlyTrashed();
    //         }
    //     });
    // }
    
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('first_name', 'like', '%'.$search.'%')
                    ->orWhere('last_name', 'like', '%'.$search.'%')
                    ->orWhere('email', 'like', '%'.$search.'%')
                    ->orWhereHas('organization', function ($query) use ($search) {
                        $query->where('name', 'like', '%'.$search.'%');
                    });
            });
        })->when($filters['trashed'] ?? null, function ($query, $trashed) {
            if ($trashed === 'with') {
                $query->withTrashed();
            } elseif ($trashed === 'only') {
                $query->onlyTrashed();
            }
        })
    }
}
