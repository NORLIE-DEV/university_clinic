<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dentalconsultation extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'appointment_id',
        'doctor_id',
        'nurse_id_1',
        'nurse_id_2',


        'medicine_issuance',
        'medicine_prescription',

        'oral_health_condition',
        'services_rendered',

        'other_assistant',
        'follow_up',
        'remarks',
        'consultation_method'
    ];

    protected $casts = [
        'medicine_issuance' => 'json',
        'medicine_prescription' => 'json',
    ];

    // public function setOralhealthconditionAttribute($value)
    // {
    //     $this->attributes['oral_health_condition'] = json_encode($value);
    // }


    // public function getOralhealthconditionAttribute($value)
    // {
    //     return json_decode($value, true);
    // }

    // public function setServicesrenderedAttribute($value)
    // {
    //     $this->attributes['services_rendered'] = json_encode($value);
    // }

    // public function getServicesrenderedAttribute($value)
    // {
    //     return json_decode($value, true);
    // }
    public function setMedicine_issuance($value)
    {
        $this->attributes['medicine_issuance'] = json_encode($value);
    }

    public function getMedicine_issuance($value)
    {
        return json_decode($value, true);
    }

    public function setMedicine_prescription($value)
    {
        $this->attributes['medicine_prescription'] = json_encode($value);
    }

    public function getMedicine_prescription($value)
    {
        return json_decode($value, true);
    }
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }
    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }

    public function appointment()
    {
        return $this->belongsTo(Appointment::class, 'appointment_id');
    }

    public function nurse()
    {
        return $this->hasOne(Nurse::class, 'nurse_id_2', 'nurse_id_1');
    }
}
