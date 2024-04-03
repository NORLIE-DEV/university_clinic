<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class Student extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'id',
        'first_name',
        'middle_name',
        'last_name',
        'gender',
        'civil_status',
        'date_of_birth',
        'birth_place',
        'permanent_address',
        'contact_number',
        'email',
        'password',
        'student_department',
        'student_level',
        'course',
        'school_year_enrolled',
        'status',
        'emergency_contact_name',
        'emergency_contact_number',
        'emergency_contact_address',
        'type',
        'image',
    ];
}
