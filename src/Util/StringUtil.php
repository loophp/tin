<?php

namespace LeKoala\Tin\Util;

use InvalidArgumentException;

/**
 * String utility
 */
class StringUtil
{
    /**
     * Remove non alphanumeric chars
     *
     * @param string $str
     * @return string
     */
    public static function clearString(string $str)
    {
        return preg_replace("[^a-zA-Z0-9]", "", $str);
    }

    /**
     * Extract string between two indexes
     *
     * @param string $str
     * @param integer $start
     * @param integer $end
     * @return string
     */
    public static function substring(string $str, int $start, int $end = null)
    {
        if ($end === null) {
            return substr($str, $start);
        }
        return substr($str, $start, $end - $start);
    }

    /**
     * Match length
     *
     * @param string $str
     * @param integer $length
     * @return boolean
     */
    public static function isFollowLength(string $str, int $length)
    {
        return strlen($str) === $length;
    }

    /**
     * Match a pattern
     *
     * @param string $str
     * @param string $pattern A regex pattern without delimiters
     * @return boolean
     */
    public static function isFollowPattern(string $str, string $pattern)
    {
        return preg_match("/$pattern/", $str);
    }

    /**
     * Get digit at a given position
     *
     * @param string $str
     * @param integer $index
     * @return integer
     */
    public static function digitAt(string $str, $index)
    {
        return (int) $str[$index];
    }

    /**
     * Get numerical value of a letter
     *
     * eg: A = 10
     *
     * @param string $str
     * @return integer
     */
    public static function getNumericValue(string $str)
    {
        if (is_numeric($str)) {
            return $str;
        }
        return ord(strtoupper($str)) - 55;
    }

    /**
     * Get the alphabetical position
     *
     * eg: A = 1
     *
     * @param string $str
     * @return integer
     */
    public static function getAlphabeticalPosition(string $str)
    {
        $arr = str_split('abcdefghijklmnopqrstuvwxyz');
        $v = array_search(strtolower($str), $arr);
        if ($v !== false) {
            return $v + 1;
        }
        return 0;
    }

    /**
     * @param string $str
     * @return boolean
     */
    public static function isUpper(string $str)
    {
        return preg_match('~^\p{Lu}~u', $str) ? true : false;
    }

    /**
     * @param string $str
     * @return boolean
     */
    public static function isLower(string $str)
    {
        return preg_match('~^\p{Ll}~u', $str) ? true : false;
    }

    /**
     * @param integer $digit
     * @param integer $radix
     * @return string
     */
    public static function forDigit(int $digit, int $radix = 10)
    {
        if ($radix != 10) {
            throw new InvalidArgumentException("Radix should be 10");
        }
        return (string) $digit;
    }

    /**
     * @param string $s
     * @param string $c
     * @param integer $pos
     * @return string
     */
    public static function removesCharacterAtPos(string $s, string $c, int $pos)
    {
        $len  = strlen($s);
        if ($pos > $len - 1) {
            return $s;
        }
        $tmp = $s[$pos];
        if ($tmp == $c) {
            $prefix = "";
            if ($pos <= $len) {
                $prefix = substr($s, 0, $pos);
            }
            $suffix = "";
            if ($pos + 1 <= $len - 1) {
                $suffix = substr($s, $pos + 1);
            }
            return $prefix . $suffix;
        }
        return $s;
    }

    /**
     * @param string $tin
     * @param integer $length
     * @return string
     */
    public static function fillWith0UntilLength(string $tin, int $length)
    {
        $normalizedTIN = $tin;
        while (strlen($normalizedTIN) < $length) {
            $normalizedTIN = "0" . $normalizedTIN;
        }
        return $normalizedTIN;
    }
}
