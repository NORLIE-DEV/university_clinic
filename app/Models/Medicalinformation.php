<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Medicalinformation extends Model
{
    use HasFactory;
    protected $primaryKey = 'id'; // Specify the custom ID as the primary key
    protected $keyType = 'string'; // Specify the data type of the custom ID

    protected $fillable = [
        'patient_id',
        'illness',
        'other_illness',
        'food_allergy',
        'medicine_allergy',
        'insect_bite_allergy',
        'other_allergy',
        'vission_of_righteye',
        'vission_of_lefteye',
        'blood_pressure',
        'pulse_rate',
        'blood_pressure_category',
        'body_temperature',
        'height',
        'weight',
        'bodymassindex',
        'bodymassindex_category',
        'injurie_status',
        'dateofinjurie',
        'name_of_hospital',
        'immunization',
        'other_immunization',
        'familyhistory',
        'other_familyhistory'

    ];

    public function setIllnessAttribute($value)
    {
        $this->attributes['illness'] = json_encode($value);
    }


    public function getIllnessAttribute($value)
    {
        return json_decode($value, true);
    }

    public function setImmunizationAttribute($value)
    {
        $this->attributes['immunization'] = json_encode($value);
    }

    public function getImmunizationAttribute($value)
    {
        return json_decode($value, true);
    }

    public function setFamilyhistoryAttribute($value)
    {
        $this->attributes['familyhistory'] = json_encode($value);
    }

    public function getFamilyhistoryAttribute($value)
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
    use HasFactory;
}
