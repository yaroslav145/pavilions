<?php
/**
 * Created by PhpStorm.
 * User: Пользователь
 * Date: 01.02.2019
 * Time: 12:26
 */

class DateWork
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


    public static function getDaysCountBetwenDates($date_start, $date_end)
    {
        return (strtotime($date_end) -  strtotime($date_start)) / (3600*24);
    }

    public static function addDaysToDate($date, $count)
    {
        return date("Y-m-d",strtotime($date) +  $count * 24 * 3600);
    }
}

?>