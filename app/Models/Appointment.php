<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Appointment extends Model
{
    use HasFactory;
    protected $fillable = [
        'doctor_id',
        'patient_id',
        'phone_number',
        'full_name',
        'date',
        'start_time',
        'end_time',
        'appointment_status',
        'notes',
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    // Define the patient relationship
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
