<?php

namespace LeKoala\Tin\Algo;

use LeKoala\Tin\Util\DateUtil;
use LeKoala\Tin\Util\StringUtil;

/**
 * Poland
 */
class PLAlgorithm extends TINAlgorithm
{
    const LENGTH_1 = 10;
    const PATTERN_1 = "\\d{10}";
    const LENGTH_2 = 11;
    const PATTERN_2 = "\\d{11}";

    public function validate(string $tin)
    {
        if (!$this->isFollowLength1($tin) && !$this->isFollowLength2($tin)) {
            return StatusCode::INVALID_LENGTH;
        }
        if (!$this->isFollowPatterns($tin)) {
            return StatusCode::INVALID_PATTERN;
        }
        if (!$this->isFollowRules($tin)) {
            return StatusCode::INVALID_SYNTAX;
        }
        return StatusCode::VALID;
    }

    public function isFollowRules(string $tin)
    {
        return ($this->isFollowLength1($tin) && $this->isFollowRulePoland1($tin)) || ($this->isFollowLength2($tin) && $this->isFollowRulePoland2($tin));
    }

    public function isFollowPatterns(string $tin)
    {
        return $this->isFollowLength1AndPattern1($tin) || $this->isFollowLength2AndPattern2AndIsValidDate($tin);
    }

    public function isFollowLength1AndPattern1(string $tin)
    {
        return $this->isFollowLength1($tin) && $this->isFollowPattern1($tin);
    }

    public function isFollowLength2AndPattern2AndIsValidDate(string $tin)
    {
        return $this->isFollowLength2($tin) && $this->isFollowPattern2($tin) && $this->isValidDate($tin);
    }

    public function isFollowLength1(string $tin)
    {
        return StringUtil::isFollowLength($tin, self::LENGTH_1);
    }

    public function isFollowPattern1(string $tin)
    {
        return StringUtil::isFollowPattern($tin, self::PATTERN_1);
    }

    public function isFollowLength2(string $tin)
    {
        return StringUtil::isFollowLength($tin, self::LENGTH_2);
    }

    public function isFollowPattern2(string $tin)
    {
        return StringUtil::isFollowPattern($tin, self::PATTERN_2);
    }

    private function isFollowRulePoland1(string $tin)
    {
        $c1 = StringUtil::digitAt($tin, 0);
        $c2 = StringUtil::digitAt($tin, 1);
        $c3 = StringUtil::digitAt($tin, 2);
        $c4 = StringUtil::digitAt($tin, 3);
        $c5 = StringUtil::digitAt($tin, 4);
        $c6 = StringUtil::digitAt($tin, 5);
        $c7 = StringUtil::digitAt($tin, 6);
        $c8 = StringUtil::digitAt($tin, 7);
        $c9 = StringUtil::digitAt($tin, 8);
        $c10 = StringUtil::digitAt($tin, 9);
        $sum = $c1 * 6 + $c2 * 5 + $c3 * 7 + $c4 * 2 + $c5 * 3 + $c6 * 4 + $c7 * 5 + $c8 * 6 + $c9 * 7;
        $remainderBy11 = $sum % 11;
        if ($remainderBy11 == 10) {
            return false;
        }
        return $c10 == $remainderBy11;
    }

    private function isFollowRulePoland2(string $tin)
    {
        $c1 = StringUtil::digitAt($tin, 0);
        $c2 = StringUtil::digitAt($tin, 1);
        $c3 = StringUtil::digitAt($tin, 2);
        $c4 = StringUtil::digitAt($tin, 3);
        $c5 = StringUtil::digitAt($tin, 4);
        $c6 = StringUtil::digitAt($tin, 5);
        $c7 = StringUtil::digitAt($tin, 6);
        $c8 = StringUtil::digitAt($tin, 7);
        $c9 = StringUtil::digitAt($tin, 8);
        $c10 = StringUtil::digitAt($tin, 9);
        $c11 = StringUtil::digitAt($tin, 10);
        $sum = $c1 * 1 + $c2 * 3 + $c3 * 7 + $c4 * 9 + $c5 * 1 + $c6 * 3 + $c7 * 7 + $c8 * 9 + $c9 * 1 + $c10 * 3;
        $lastDigit = $sum % 10;
        return $c11 == 10 - $lastDigit;
    }

    private function isValidDate(string $tin)
    {
        $year = intval(StringUtil::substring($tin, 0, 2));
        $month = intval(StringUtil::substring($tin, 2, 4));
        $day = intval(StringUtil::substring($tin, 4, 6));
        if ($month >= 1 && $month <= 12) {
            return DateUtil::validate(1900 + $year, $month, $day);
        }
        if ($month >= 21 && $month <= 32) {
            return DateUtil::validate(2000 + $year, $month - 20, $day);
        }
        if ($month >= 41 && $month <= 52) {
            return DateUtil::validate(2100 + $year, $month - 40, $day);
        }
        if ($month >= 61 && $month <= 72) {
            return DateUtil::validate(2200 + $year, $month - 60, $day);
        }
        return $month >= 81 && $month <= 92 && DateUtil::validate(1800 + $year, $month - 80, $day);
    }
}
