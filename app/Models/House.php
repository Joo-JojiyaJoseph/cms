<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class House extends Model
{
    use HasFactory;

    protected $fillable = ['ward_id', 'house_name', 'number_of_members','address','about','member_of_parish_since'];

    public function ward()
    {
        return $this->belongsTo(Ward::class);
    }

    // Assuming Family has many Members
    public function members()
    {
        return $this->hasMany(FamilyMember::class);
    }
}
