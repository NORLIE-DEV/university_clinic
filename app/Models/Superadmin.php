<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Superadmin extends Authenticatable
{
    protected $primaryKey = 'id'; // Specify the custom ID as the primary key
    protected $keyType = 'string'; // Specify the data type of the custom ID
    use HasFactory;

    protected $fillable = [
        'name',
        'phonenumber',
        'email',
        'password',
        'birthdate',
        'gender',
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
}
