<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Medicinestock extends Model
{
    protected $primaryKey = 'id'; // Specify the custom ID as the primary key
    protected $keyType = 'string'; // Specify the data type of the custom ID
    protected $fillable = [
        'medicine_id',
        'batch_id',
        'date_recieve',
        'expiration_date',
        'quantity'
    ];
    public function medicine()
    {
        return $this->belongsTo(Medicine::class, 'medicine_id');
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
