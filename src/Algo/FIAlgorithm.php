<?php

namespace LeKoala\Tin\Algo;

use LeKoala\Tin\Util\DateUtil;
use LeKoala\Tin\Util\StringUtil;

/**
 * Finland
 */
class FIAlgorithm extends TINAlgorithm
{
    const LENGTH = 11;
    const PATTERN = "[0-3]\\d[0-1]\\d{3}[+-A]\\d{3}[0-9A-Z]";

    public function validate(string $tin)
    {
        if (!$this->isFollowLength($tin)) {
            return StatusCode::INVALID_LENGTH;
        }
        if (!$this->isFollowPattern($tin) || !$this->isValidDate($tin)) {
            return StatusCode::INVALID_PATTERN;
        }
        if (!$this->isFollowRules($tin)) {
            return StatusCode::INVALID_SYNTAX;
        }
        return StatusCode::VALID;
    }

    public function isFollowLength(string $tin)
    {
        return StringUtil::isFollowLength($tin, self::LENGTH);
    }

    public function isFollowPattern(string $tin)
    {
        return StringUtil::isFollowPattern($tin, self::PATTERN);
    }

    public function isFollowRules(string $tin)
    {
        return $this->isFollowFinlandRule($tin);
    }

    public function isFollowFinlandRule(string $tin)
    {
        $number = intval(StringUtil::substring($tin, 0, 6) . StringUtil::substring($tin, 7, 10));
        $remainderBy31 = $number % 31;
        $c11 = $tin[10];
        return $this->getMatch($remainderBy31) == $c11;
    }

    public function getMatch($number)
    {
        if ($number < 10) {
            return StringUtil::forDigit($number, 10);
        }
        switch ($number) {
            case 10:
                return 'A';
            case 11:
                return 'B';
            case 12:
                return 'C';
            case 13:
                return 'D';
            case 14:
                return 'E';
            case 15:
                return 'F';
            case 16:
                return 'H';
            case 17:
                return 'J';
            case 18:
                return 'K';
            case 19:
                return 'L';
            case 20:
                return 'M';
            case 21:
                return 'N';
            case 22:
                return 'P';
            case 23:
                return 'R';
            case 24:
                return 'S';
            case 25:
                return 'T';
            case 26:
                return 'U';
            case 27:
                return 'V';
            case 28:
                return 'W';
            case 29:
                return 'X';
            case 30:
                return 'Y';
            default:
                return ' ';
        }
    }

    private function isValidDate(string $tin)
    {
        $day = intval(StringUtil::substring($tin, 0, 2));
        $month = intval(StringUtil::substring($tin, 2, 4));
        $year = intval(StringUtil::substring($tin, 4, 6));
        $c7 = StringUtil::substring($tin, 6, 7);
        if ("+" == $c7) {
            return DateUtil::validate(1800 + $year, $month, $day);
        }
        if ("-" == $c7) {
            return DateUtil::validate(1900 + $year, $month, $day);
        }
        return "A" == $c7 && DateUtil::validate(2000 + $year, $month, $day);
    }
}
