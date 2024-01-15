<?php

namespace App\Repositories;

use App\Models\OlympicDay;

class OlympicExamDaysRepository
{
    public function getAllDays(){
        return OlympicDay::latest()->get();
    }

    public function getDayById($id){
        return OlympicDay::find($id);
    }

    public function getLatestDay(){
        $day = OlympicDay::latest()->first();
        return $day;
    }

    public function new_day($date, $amount, $name, $logo, $partner, $description){
        OlympicDay::insert([
            'name' => $name,
            'logo' => $logo,
            'partner' => $partner,
            'description' => $description,
            'date' => $date,
            'amount' => $amount,
        ]);
    }
}
