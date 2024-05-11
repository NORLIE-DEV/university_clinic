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

    public function medicalConsultation()
    {
        return $this->hasOne(MedicalConsultation::class);
    }

    public function dentalConsultation()
    {
        return $this->hasOne(Dentalconsultation::class);
    }

    public function hasPassed()
    {
        // Assuming 'date' is the column name for the appointment date
        return now()->toDateString() > $this->date;
    }
}
