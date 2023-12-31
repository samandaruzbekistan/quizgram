<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrQuizzes extends Model
{
    use HasFactory;

    protected $table = 'pr_quizzes';

    public function answers() {
        return $this->hasMany(PrAnswers::class, 'quiz_id');
    }
}
