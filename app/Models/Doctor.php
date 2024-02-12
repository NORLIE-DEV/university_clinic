<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Doctor extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $keyType = 'string';

    protected $fillable = [
        'department',
        'name',
        'phone_number',
        'email',
        'password',
        'gender',
        'designation',
        'qualification',
        'experience',
        'specialization',
        'bio',
        'address',
        'status',
        'image',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = Str::uuid()->toString();
        });
    }
}
