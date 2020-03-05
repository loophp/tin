<?php

namespace LeKoala\Tin\Util;

use LeKoala\Tin\Exception\NegativeNumberException;

/**
 * Number utility
 */
class NumberUtil
{
    /**
     * @param integer $number
     * @return integer
     */
    public static function sumDigit(int $number)
    {
        if ($number < 0) {
            throw new NegativeNumberException("Parameter has to be positive.");
        }
        $s = (string) $number;
        $sum = 0;
        for ($i = 0; $i < strlen($s); $i++) {
            $sum += (int) $s[$i];
        }
        return $sum;
    }



    /**
     * @param integer $number
     * @return integer
     */
    public static function getNextTens($number)
    {
        if ($number < 0) {
            throw new NegativeNumberException("Parameter has to be positive.");
        }
        $s = (string) $number;
        if (strlen($s) == 1) {
            return 10;
        }
        $tens = (int) $s[0];
        return ($tens + 1) * 10;
    }

    /**
     * @param integer $number
     * @return integer
     */
    public static function getUnit($number)
    {
        if ($number < 0) {
            throw new NegativeNumberException("Parameter has to be positive.");
        }
        $s = (string) $number;
        return (int) $s[strlen($s) - 1];
    }

    /**
     * @param integer $value
     * @param integer $minValue
     * @param integer $maxValue
     * @return boolean
     */
    public static function isInRange(int $value, int $minValue, int $maxValue)
    {
        return $value > $minValue && $value < $maxValue;
    }

    /**
     * @param array $numbers
     * @return integer
     */
    public function getMinValue($numbers)
    {
        $minValue = $numbers[0];
        for ($i = 1; $i < count($numbers); $i++) {
            if ($numbers[$i] < $minValue) {
                $minValue = $numbers[$i];
            }
        }
        return $minValue;
    }
}
