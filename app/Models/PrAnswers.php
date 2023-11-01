<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrAnswers extends Model
{
    use HasFactory;

    protected $table = 'pr_answers';

    public function quiz() {
        return $this->belongsTo(PrQuizzes::class, 'quiz_id');
    }
}
