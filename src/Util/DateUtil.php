<?php

namespace LeKoala\Tin\Util;

/**
 * Date utility
 */
class DateUtil
{
    const JANUARY = 1;
    const FEBRUARY = 2;
    const DECEMBER = 12;

    /**
     * @param integer $year
     * @return boolean
     */
    private static function isLeapYear(int $year)
    {
        return ($year % 4 == 0 && $year % 100 != 0) || $year % 400 == 0;
    }

    /**
     * @param integer $month
     * @param integer $year
     * @return integer
     */
    private static function getLastDayOfMonth(int $month, int $year)
    {
        $lastDayOfMonth = [0, 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
        if ($month == 2 && self::isLeapYear($year)) {
            return 29;
        }
        return $lastDayOfMonth[$month];
    }

    /**
     * @param integer $year
     * @param integer $month
     * @param integer $day
     * @return boolean
     */
    public static function validate(int $year, int $month, int $day)
    {
        return $month >= 1 && $month <= 12 && $day >= 1 && $day <= self::getLastDayOfMonth($month, $year);
    }
}
