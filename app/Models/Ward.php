<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    protected $fillable = ['name', 'image'];
    public function houses()
{
    return $this->hasMany(House::class);
}

public function families()
{
    return $this->hasManyThrough(FamilyMember::class, House::class);
}
}
