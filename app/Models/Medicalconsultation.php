<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Medicalconsultation extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'appointment_id',
        'doctor_id',
        'nurse_id_1',
        'nurse_id_2',
        'pulse_rate',
        'respiratory_rate',
        'blood_pressure',
        'body_temp',
        'height',
        'weight',
        'chief_complaints',
        'medicine_issuance',
        'medicine_prescription',
        'clinical_diagnosis',
        'treatment_given',
        'injuries',
        'vsud_pulse_rate',
        'vsud_respiratory_rate',
        'vsud_blood_pressure',
        'vsud_body_temp',
        'vsud_conditional_findings',
        'assistedBy',
        'other_assistant',
        'transfferofcare',
        'remarks',
        'timeout'
    ];

    protected $casts = [
        'chief_complaints' => 'json',
        'medicine_issuance' => 'json',
        'medicine_prescription' => 'json',
        'clinical_diagnosis' => 'json',
        'treatment_given' => 'json',
        'injuries' => 'json',
    ];

    public function setChief_complaints($value)
    {
        $this->attributes['chief_complaints'] = json_encode($value);
    }


    public function getChief_complaints($value)
    {
        return json_decode($value, true);
    }

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

    public function setClinical_diagnosis($value)
    {
        $this->attributes['clinical_diagnosis'] = json_encode($value);
    }
    public function getClinical_diagnosis($value)
    {
        return json_decode($value, true);
    }
    public function setTreatment_given($value)
    {
        $this->attributes['treatment_given'] = json_encode($value);
    }
    public function getTreatment_given($value)
    {
        return json_decode($value, true);
    }
    public function setJnjuries($value)
    {
        $this->attributes['injuries'] = json_encode($value);
    }
    public function getJnjuries($value)
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
