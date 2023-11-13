<?php

namespace App\Repositories;

use App\Models\PrExamDay;

class PrExamDayRepository
{
    public function getAllDays(){
        return PrExamDay::latest()->get();
    }

    public function getDayById($id){
        return PrExamDay::find($id);
    }

    public function getLatestDay(){
        $day = PrExamDay::latest()->first();
        return $day;
    }

    public function new_day($date, $amount){
        PrExamDay::insert([
            'date' => $date,
            'amount' => $amount,
        ]);
    }

    public function incrementQuizCount($exam_day_id){
        $exam_day = PrExamDay::find($exam_day_id);
        $q_count = $exam_day->quiz_count+1;
        $exam_day->update([
            'quiz_count' => $q_count
        ]);
    }

    public function decrementQuizCount($exam_day_id){
        $exam_day = PrExamDay::find($exam_day_id);
        $q_count = $exam_day->quiz_count-1;
        $exam_day->update([
            'quiz_count' => $q_count
        ]);
    }
}
