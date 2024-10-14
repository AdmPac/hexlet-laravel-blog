<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Класс отзывов к объявлению
 */
class Feedback extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function adboard()
    {
        return $this->belongsTo(Adboard::class);
    }
}
