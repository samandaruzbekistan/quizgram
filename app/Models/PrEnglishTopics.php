<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrEnglishTopics extends Model
{
    use HasFactory;

    public function examDay() {
        return $this->belongsTo(PrExamDay::class, 'exam_day_id');
    }

    public function quizzes() {
        return $this->hasMany(PrEnglishQuizzes::class, 'topic_id');
    }
}
