<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
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
        'employee_department',
        'employee_position',
        'status',
        'emergency_contact_name',
        'emergency_contact_number',
        'emergency_contact_address',
        'image',
    ];
}
