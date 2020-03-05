<?php

namespace LeKoala\Tin\Algo;

use LeKoala\Tin\Util\DateUtil;
use LeKoala\Tin\Util\StringUtil;

/**
 * Bulgaria
 */
class BGAlgorithm extends TINAlgorithm
{
    const LENGTH = 10;
    const PATTERN = "\\d{10}";

    public function validate(string $tin)
    {
        if (!$this->isFollowLength($tin)) {
            return StatusCode::INVALID_LENGTH;
        }
        if (!$this->isFollowPattern($tin) || !$this->isValidDate($tin)) {
            return Statuscode::INVALID_PATTERN;
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
        return $this->isFollowBulgariaRule($tin);
    }

    public function isFollowBulgariaRule(string $tin)
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
        $sum = $c1 * 2 + $c2 * 4 + $c3 * 8 + $c4 * 5 + $c5 * 10 + $c6 * 9 + $c7 * 7 + $c8 * 3 + $c9 * 6;
        $remainderBy11 = $sum % 11;
        if ($remainderBy11 == 10) {
            return $c10 == 0;
        }
        return $remainderBy11 == $c10;
    }

    /**
     * @param string $tin
     * @return boolean
     */
    private function isValidDate(string $tin)
    {
        $year = intval(StringUtil::substring($tin, 0, 2));
        $month = intval(StringUtil::substring($tin, 2, 4));
        $day = intval(StringUtil::substring($tin, 4, 6));
        if ($month >= 21 && $month <= 32) {
            return DateUtil::validate(1800 + $year, $month - 20, $day);
        }
        if ($month >= 41 && $month <= 52) {
            return DateUtil::validate(2000 + $year, $month - 40, $day);
        }
        return DateUtil::validate(1900 + $year, $month, $day);
    }
}
