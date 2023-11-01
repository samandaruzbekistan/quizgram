<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrEnglishQuizzes extends Model
{
    use HasFactory;

    public function topic() {
        return $this->belongsTo(PrEnglishTopics::class, 'topic_id');
    }

    public function answers() {
        return $this->hasMany(PrEnglishAnswers::class, 'quiz_id');
    }
}
