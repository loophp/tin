<?php

namespace LeKoala\Tin\Algo;

use LeKoala\Tin\Util\DateUtil;
use LeKoala\Tin\Util\StringUtil;

/**
 * Estonia
 */
class EEAlgorithm extends TINAlgorithm
{
    const LENGTH = 11;
    const PATTERN = "[1-6]\\d{2}[0-1]\\d[0-3]\\d{5}";

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
        return $this->isFollowRangeRule($tin) && $this->isFollowEstoniaRule($tin);
    }

    public function isFollowRangeRule(string $tin)
    {
        $range = intval(StringUtil::substring($tin, 7, 10));
        return $range > 0 && $range < 711;
    }

    public function isFollowEstoniaRule(string $tin)
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
        $sum = $c1 + $c2 * 2 + $c3 * 3 + $c4 * 4 + $c5 * 5 + $c6 * 6 + $c7 * 7 + $c8 * 8 + $c9 * 9 + $c10;
        $remainderBy11 = $sum % 11;
        return ($remainderBy11 < 10 && $remainderBy11 == $c11) || ($remainderBy11 == 10 && $this->isFollowEstoniaRulePart2($tin));
    }

    public function isFollowEstoniaRulePart2(string $tin)
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
        $sum = $c1 * 3 + $c2 * 4 + $c3 * 5 + $c4 * 6 + $c5 * 7 + $c6 * 8 + $c7 * 9 + $c8 + $c9 * 2 + $c10 * 3;
        $remainderBy11 = $sum % 11;
        return ($remainderBy11 < 10 && $remainderBy11 == $c11) || ($remainderBy11 == 10 && $c11 == 0);
    }

    private function isValidDate(string $tin)
    {
        $year = intval(StringUtil::substring($tin, 1, 3));
        $month = intval(StringUtil::substring($tin, 3, 5));
        $day = intval(StringUtil::substring($tin, 5, 7));
        return DateUtil::validate(1900 + $year, $month, $day) || DateUtil::validate(2000 + $year, $month, $day);
    }
}
