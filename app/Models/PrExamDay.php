<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrExamDay extends Model
{
    use HasFactory;
    protected $fillable = ['quiz_count'];
    protected $table = 'pr_exam_days';

    public function quizSections() {
        return $this->hasMany(QuizSection::class, 'exam_day_id');
    }

}
