<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FamilyMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'house_id',
        'name',
        'dob',
        'blood_group',
        'married',
        'marriage_date',
        'spouse',
        'job',
        'place',
        'address',
        'job_location',
        'contact_no_1',
        'contact_no_2',
        'email',
        'baptism_date',
    ];

    public function house()
    {
        return $this->belongsTo(House::class);
    }

    public function getAgeAttribute()
    {
        if ($this->dob) {
            return \Carbon\Carbon::parse($this->dob)->age;
        }
        return null;
    }
}
