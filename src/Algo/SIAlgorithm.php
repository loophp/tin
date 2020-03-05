<?php

namespace LeKoala\Tin\Algo;

use LeKoala\Tin\Util\NumberUtil;
use LeKoala\Tin\Util\StringUtil;

/**
 * Slovenia
 */
class SIAlgorithm extends TINAlgorithm
{
    const LENGTH = 8;
    const PATTERN = "[1-9]\\d{7}";

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
        return $this->isFollowRangeRule($tin) && $this->isFollowSloveniaRule($tin);
    }

    public function isFollowRangeRule(string $tin)
    {
        $intTIN = intval(StringUtil::substring($tin, 0, 7));
        return NumberUtil::isInRange($intTIN, 999999, 10000000);
    }

    public function isFollowSloveniaRule(string $tin)
    {
        $c1 = StringUtil::digitAt($tin, 0);
        $c2 = StringUtil::digitAt($tin, 1);
        $c3 = StringUtil::digitAt($tin, 2);
        $c4 = StringUtil::digitAt($tin, 3);
        $c5 = StringUtil::digitAt($tin, 4);
        $c6 = StringUtil::digitAt($tin, 5);
        $c7 = StringUtil::digitAt($tin, 6);
        $c8 = StringUtil::digitAt($tin, 7);
        $sum = $c1 * 8 + $c2 * 7 + $c3 * 6 + $c4 * 5 + $c5 * 4 + $c6 * 3 + $c7 * 2;
        $remainderBy11 = $sum % 11;
        return $c8 == 11 - $remainderBy11 || (11 - $remainderBy11 == 10 && $c8 == 0);
    }
}
