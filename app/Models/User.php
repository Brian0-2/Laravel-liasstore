<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
// Relacion de usuarios con sus roles y permisos
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail

{
    // Se implementa HasRoles para los Roles de los usuarios
    use HasApiTokens, HasFactory, Notifiable,HasRoles;

    protected $fillable = [
        'name',
        'email',
        'address',
        'postal_code',
        'location',
        'municipality',
        'state',
        'phone_number',
        'password'
    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
