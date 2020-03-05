<?php

namespace LeKoala\Tin\Algo;

use LeKoala\Tin\Util\StringUtil;

/**
 * Portugal
 */
class PTAlgorithm extends TINAlgorithm
{
    const LENGTH = 9;
    const PATTERN = "\\d{9}";

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
        $c1 = StringUtil::digitAt($tin, 0);
        $c2 = StringUtil::digitAt($tin, 1);
        $c3 = StringUtil::digitAt($tin, 2);
        $c4 = StringUtil::digitAt($tin, 3);
        $c5 = StringUtil::digitAt($tin, 4);
        $c6 = StringUtil::digitAt($tin, 5);
        $c7 = StringUtil::digitAt($tin, 6);
        $c8 = StringUtil::digitAt($tin, 7);
        $c9 = StringUtil::digitAt($tin, 8);
        $sum = $c1 * 9 + $c2 * 8 + $c3 * 7 + $c4 * 6 + $c5 * 5 + $c6 * 4 + $c7 * 3 + $c8 * 2;
        $remainderBy11 = $sum % 11;
        $checkDigit = 11 - $remainderBy11;
        if ($checkDigit <= 9) {
            return $checkDigit == $c9;
        }
        if ($checkDigit == 10) {
            return 0 == $c9;
        }
        return 0 == $c9;
    }
}
