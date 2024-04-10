<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Timing extends Model
{
    protected $primaryKey = 'id';
    protected $keyType = 'string';

    protected $fillable = ['doctor_id', 'day_of_week', 'shift', 'start_time', 'end_time', 'average_consultation_time'];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = Str::uuid()->toString();
        });
    }
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }


    // public function isBooked($date, $startTime)
    // {

    //     return Appointment::where('date', $date)
    //         ->where('start_time', $startTime)
    //         ->exists();
    // }

    use HasFactory;
}

