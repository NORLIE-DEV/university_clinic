<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;

class Doctor extends Model implements Authenticatable
{
    use HasFactory;
    use AuthenticatableTrait;

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

    /**
     * Get the name of the unique identifier for the user.
     *
     * @return string
     */
    public function getAuthIdentifierName()
    {
        return 'id';
    }

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->getAttribute($this->getAuthIdentifierName());
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->password;
    }

    /**
     * Get the remember token for the user.
     *
     * @return string|null
     */
    public function getRememberToken()
    {
        return null;
    }

    /**
     * Set the remember token for the user.
     *
     * @param  string  $value
     * @return void
     */
    public function setRememberToken($value)
    {
    }

    /**
     * Get the column name for the "remember me" token.
     *
     * @return string
     */
    public function getRememberTokenName()
    {
        return '';
    }

    public function timings()
    {
        return $this->hasMany(Timing::class);
    }
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
