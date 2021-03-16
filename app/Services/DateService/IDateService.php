<?php

namespace App\Services\DateService;

interface IDateService
{
    public function getMonthName();
    public function now();
    public function getStartOfMonth();
}