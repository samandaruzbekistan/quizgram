<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrExam extends Model
{
    use HasFactory;
    protected $table = 'pr_exams';

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function examDay() {
        return $this->belongsTo(PrExamDay::class, 'exam_day_id');
    }
}
