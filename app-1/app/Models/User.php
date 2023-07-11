<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [ //intoducir registros desde el ORM a la DB 
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [ //no me muestra estos campos de la BD, al pedir la info (exclude de sequelize)
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [ // para formatear datos, darle tipo
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    //metodos propios (esto lo hemos escrito nosotros)
        //relaciones
    public function role() {
        return $this -> belongsTo(Role::class);
    }

    
    public function multitask(){
        return $this -> belongsToMany(Multitask::class, 'multitask_user', 'user_id', 'multitask_id'); //primer id del modelo en el que estoy
    }
}

