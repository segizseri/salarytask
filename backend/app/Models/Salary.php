<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    use HasFactory;

    //Обязательные пенсионные взносы
    const TYPE_PERCENT_CPC = 0.1;

    //Обязательное социальное медицинское страхование
    const TYPE_PERCENT_CSHI = 0.02;

    //Взносы на обязательное социальное медицинское Страхование
    const TYPE_PERCENT_CCSHI = 0.02;

    //Социальные отчисления
    const TYPE_PERCENT_SSC = 0.035;

    //Норма дней в месяц (обычно 22)
    const NORM_DAYS_MONTH = 22;

    //Если заработная плата за месяц меньше 25 МРП (1МРП = 3063 T)
    const MIDDLE_SALARY_MONTH = 76575;

    //882 МРП
    const TYPE_SALARY_DISABILITY = 2701566;
    // Минимальная зароботная плата
    const MIN_SALARY = 42500;

}
