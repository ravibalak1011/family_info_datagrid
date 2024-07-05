<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'surname', 'birthdate', 'mobile_no', 'address', 'state', 'city', 'pincode', 'marital_status', 'wedding_date', 'hobbies', 'photo',
    ];

    protected $casts = [
        'hobbies' => 'array',
    ];

    public function state()
    {
        return $this->belongsTo(State::class, 'state');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city');
    }
    public function members()
    {
        return $this->hasMany(FamilyMember::class);
    }
}