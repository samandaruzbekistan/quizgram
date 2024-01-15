<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OlympicQuiz extends Model
{
    use HasFactory;

    public function answers() {
        return $this->hasMany(OlympicAnswer::class, 'quiz_id');
    }
}
