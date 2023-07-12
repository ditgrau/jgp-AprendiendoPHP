<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'user_id',
        'status'
    ];
    //para el create /update necesitamos que los campos editables esten definidos en fillable 

    public function user() {
        return $this->belongsTo(User::class);
    }
}