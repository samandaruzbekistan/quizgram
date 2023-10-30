<?php

namespace App\Repositories;

use App\Models\PrExamDay;

class PrExamDayRepository
{
    public function getAllDays(){
        return PrExamDay::latest()->get();
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
}
