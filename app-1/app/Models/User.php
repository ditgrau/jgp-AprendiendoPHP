<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, SoftDeletes, Notifiable;
    // use SoftDeletes (TIMESTAMP: deletedAt)


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
         //intoducir registros desde el ORM a la DB 
        'name',
        'surname',
        'email',
        'password',
        'role_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [ 
        //no me muestra estos campos de la BD, al pedir la info (exclude de sequelize)
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [ 
        // para formatear datos, darle tipo
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    //metodos propios (esto lo hemos escrito nosotros)
        //relaciones
    public function role() {
        return $this -> belongsTo(Role::class);
    }

    public function task() {
        return $this->hasMany(Task::class);
    }
    
    public function multitask(){
        return $this -> belongsToMany(Multitask::class, 'multitask_user', 'user_id', 'multitask_id'); //primer id del modelo en el que estoy
    //modelo de la tabla con la que se relaciona, tabla intermedia, id del modelo en el que estoy, id del modelo con el que se relaciona
    }
}

