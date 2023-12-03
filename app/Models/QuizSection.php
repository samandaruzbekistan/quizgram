<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizSection extends Model
{
    use HasFactory;

    public function quizzes() {
        return $this->hasMany(PrQuizzes::class, 'section_id');
    }
}
