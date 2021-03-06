<?php

namespace App\Services\DateService;

use App\Services\DateService\IDateService;
use Carbon\Carbon;

class DateService implements IDateService
{
    public function getMonthName()
    {
        return Carbon::now()->monthName;
    }

    public function now()
    {
        return Carbon::now();
    }

    public function getStartOfMonth()
    {
       return Carbon::now()->startOfMonth();
    }
}



