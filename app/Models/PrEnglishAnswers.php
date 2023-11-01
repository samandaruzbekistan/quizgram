<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrEnglishAnswers extends Model
{
    use HasFactory;

    public function quiz() {
        return $this->belongsTo(PrEnglishQuizzes::class, 'quiz_id');
    }
}
