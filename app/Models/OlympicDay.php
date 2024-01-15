<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OlympicDay extends Model
{
    use HasFactory;
    protected $fillable = ['quiz_count'];

    public function quizSections() {
        return $this->hasMany(OlympicQuizSection::class, 'exam_day_id');
    }
}
