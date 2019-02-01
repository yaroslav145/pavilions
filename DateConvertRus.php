<?php
/**
 * Created by PhpStorm.
 * User: Пользователь
 * Date: 01.02.2019
 * Time: 12:26
 */

class DateConvertRus
{
    private static $arr_month = [
    'январь',
    'февраль',
    'март',
    'апрель',
    'май',
    'июнь',
    'июль',
    'август',
    'сентябрь',
    'октябрь',
    'ноябрь',
    'декабрь'
    ];

    public static function dateToMonth($dateForConvert)
    {
        return self::$arr_month[date('n', strtotime($dateForConvert)) - 1];
    }
}

?>