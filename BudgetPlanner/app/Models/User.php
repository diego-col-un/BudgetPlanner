<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

// importamos los metodos para el JWT
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // obtenemos el identificador que se almacenara en el JWT
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    // retorna un array que contiene cualquier reclamo que queramos agregar al JWT
    public function getJWTCustomClaims()
    {
        return [];
    }


    // public function role()
    // {
    //     return $this->belongsTo(Role::class);
    // }

    public function budgets()
    {
        return $this->hasMany(Budget::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}


// class UserApi extends Authenticatable implements JWTSubject
// {
//     use HasApiTokens, HasFactory, Notifiable;

//     protected $fillable = [
//         'name',
//         'email',
//         'password',
//     ];

//     protected $hidden = [
//         'password',
//         'remember_token',
//     ];

//     protected $casts = [
//         'email_verified_at' => 'datetime',
//     ];

//     // obtenemos el identificador que se almacenrara en el JWT
//     public function getJWTIdentifier()
//     {
//         return $this->getKey();
//     }

//     // retorna un array que contiene cualquier reclamo que queramos agregar al JWT
//     public function getJWTCustomClaims()
//     {
//         return [];
//     }

//     public function role()
//     {
//         return $this->belongsTo(Role::class);
//     }

//     public function budgets()
//     {
//         return $this->hasMany(Budget::class);
//     }
// }