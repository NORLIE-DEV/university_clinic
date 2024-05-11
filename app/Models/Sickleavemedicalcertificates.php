<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sickleavemedicalcertificates extends Model
{
    use HasFactory;

    protected $fillable = [
        'certificateID',
        'doctor_id',
        'patient_id',
        'absent_from',
        'absent_to',
        'number_days_absent',
        'date_issue',
        'reason',
        'findings',
        'remarks',
    ];
}
