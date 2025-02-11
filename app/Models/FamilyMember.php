<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FamilyMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'house_id', 'full_name', 'primary_contact', 'secondary_contact', 'whatsapp_number',
        'email', 'dob', 'blood_group', 'marital_status', 'marriage_date',
        'job', 'current_job_location', 'permanent_address', 'present_address',
        'same_as_permanent', 'baptism_name', 'baptism_date', 'confirmation_date', 'relationship','gender','spouse','image'
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
