<?php

namespace LeKoala\Tin\Algo;

use LeKoala\Tin\Util\DateUtil;
use LeKoala\Tin\Util\StringUtil;

/**
 * Lithuania
 */
class LTAlgorithm extends TINAlgorithm
{
    const LENGTH = 11;
    const PATTERN = "[1-6]\\d{2}[0-1]\\d[0-3]\\d{5}";

    public function validate(string $tin)
    {
        if (!$this->isFollowLength($tin)) {
            return StatusCode::INVALID_LENGTH;
        }
        if (!$this->isFollowPattern($tin)) {
            return StatusCode::INVALID_PATTERN;
        }
        if (!$this->isFollowRules($tin)) {
            return StatusCode::INVALID_SYNTAX;
        }
        return StatusCode::VALID;
    }

    private function checkMonth(string $tin)
    {
        $month = intval(StringUtil::substring($tin, 3, 5));
        return $month > 0 && $month < 13;
    }

    private function checkDay(string $tin)
    {
        $day = intval(StringUtil::substring($tin, 5, 7));
        return $day > 0 && $day < 32;
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
        $sum = 0;
        $c11 = intval(StringUtil::substring($tin, 10));
        for ($i = 0; $i < 10; $i++) {
            $sum += $this->multiplyAccordingToWeight(intval(StringUtil::substring($tin, $i, $i + 1)), $i);
        }
        $remainderBy11 = $sum % 11;
        if ($remainderBy11 != 10) {
            return $c11 == $remainderBy11;
        }
        $sum2 = 0;
        for ($j = 0; $j < 10; $j++) {
            $sum2 += $this->multiplyAccordingToWeight2(intval(StringUtil::substring($tin, $j, $j + 1)), $j);
        }
        $remainderBy11 = $sum2 % 11;
        if ($remainderBy11 == 10) {
            return $c11 == 0;
        }
        return $c11 == $remainderBy11;
    }

    protected function multiplyAccordingToWeight($val, $index)
    {
        switch ($index) {
            case 0:
                return $val * 1;
            case 1:
                return $val * 2;
            case 2:
                return $val * 3;
            case 3:
                return $val * 4;
            case 4:
                return $val * 5;
            case 5:
                return $val * 6;
            case 6:
                return $val * 7;
            case 7:
                return $val * 8;
            case 8:
                return $val * 9;
            case 9:
                return $val * 1;
            default:
                return -1;
        }
    }

    protected function multiplyAccordingToWeight2($val, $index)
    {
        switch ($index) {
            case 0:
                return $val * 3;
            case 1:
                return $val * 4;
            case 2:
                return $val * 5;
            case 3:
                return $val * 6;
            case 4:
                return $val * 7;
            case 5:
                return $val * 8;
            case 6:
                return $val * 9;
            case 7:
                return $val * 1;
            case 8:
                return $val * 2;
            case 9:
                return $val * 3;
            default:
                return -1;
        }
    }

    private function isValidDate(string $tin)
    {
        $day = intval(StringUtil::substring($tin, 5, 7));
        $month = intval(StringUtil::substring($tin, 3, 5));
        $year = intval(StringUtil::substring($tin, 1, 3));
        return DateUtil::validate(1900 + $year, $month, $day) || DateUtil::validate(2000 + $year, $month, $day);
    }
}
