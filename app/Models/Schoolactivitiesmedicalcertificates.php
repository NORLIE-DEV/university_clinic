<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schoolactivitiesmedicalcertificates extends Model
{
    use HasFactory;
    protected $fillable = [
        'certificateID',
        'doctor_id',
        'patient_id',
        'activity',
        'blood_pressure',
        'respiratory_rate',
        'pulse_rate',
        'height',
        'weight',
        'findings',
        'recomendations',
        'date_issue',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }
}
