<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Medicalhistory extends Model
{
    use HasFactory;
    protected $primaryKey = 'id'; // Specify the custom ID as the primary key
    protected $keyType = 'string'; // Specify the data type of the custom ID

    protected $fillable = [
        'patient_id',
        'father_first_name',
        'father_middle_name',
        'father_last_name',
        'father_cp_number',
        'father_email',
        'mother_first_name',
        'mother_middle_name',
        'mother_last_name',
        'mother_cp_number',
        'mother_email',
        'emergency_contact_name',
        'emergency_contact_number',
        'food_allergy',
        'medicine_allergy',
        'other_allergy',
        'illness', // Include 'illness' in the fillable array
        // Add any other attributes you want to make fillable
    ];

    public function setIllnessAttribute($value)
    {
        $this->attributes['illness'] = json_encode($value);
    }


    public function getIllnessAttribute($value)
    {
        return json_decode($value, true);
    }
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }
    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->id) {
                $model->id = Str::uuid()->toString(); // Generate a UUID only if the ID is not set
            }
        });
    }
}
