<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrExamDay extends Model
{
    use HasFactory;
    protected $fillable = ['quiz_count'];
    protected $table = 'pr_exam_days';

    public function quizzes() {
        return $this->hasMany(PrQuizzes::class, 'exam_day_id');
    }

    public function englishTopics() {
        return $this->hasMany(PrEnglishTopics::class, 'exam_day_id');
    }
}
