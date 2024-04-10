<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Patient extends Authenticatable
{
    use HasFactory;

    protected $primaryKey = 'id'; // Specify the custom ID as the primary key
    protected $keyType = 'string'; // Specify the data type of the custom ID
    protected $fillable = ['student_id', 'employee_id'];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function medicalInfo()
    {
        return $this->hasMany(Medicalinformation::class);
    }

    public function getAuthIdentifierName()
    {
        return 'id'; // Assuming 'id' is the primary key column name
    }

    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getRememberToken()
    {
        return null; // not used
    }

    public function setRememberToken($value)
    {
        // not used
    }

    public function getRememberTokenName()
    {
        return null; // not used
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
