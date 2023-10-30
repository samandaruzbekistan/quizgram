<?php

namespace App\Repositories;

use App\Models\PrExamDay;

class PrExamDayRepository
{
    public function getAllDays(){
        return PrExamDay::latest()->get();
    }
}
