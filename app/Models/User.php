<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fullName',
        'email',
        'course',
        'password',
        'phoneNo',
        'matricId',
        'address',
        'dateOfBirth',
        'nationality',
        'qualification',
        'roomLocation',
        'position',
        'faculty',
        'department',
        'role',
        'icNo',
        'imagePath',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    protected function role(): Attribute
    {
        return new Attribute(
            get:function ($value) {
                $roles = ["client", "counselor", "admin"];
                return $roles[$value] ?? null;
            }
        );
    }

}
