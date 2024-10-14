<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * Класс специализации
 */
class Specialization extends Model
{
    use HasFactory;
    public function user()
    {
        return $this->belongsToMany(User::class, 'user_id');
    } 

    public function adboard()
    {
        return $this->hasOne(Adboard::class);
    }
}
