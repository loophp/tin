<?php

namespace LeKoala\Tin\Algo;

use LeKoala\Tin\Util\StringUtil;

/**
 * Ireland
 */
class IEAlgorithm extends TINAlgorithm
{
    const LENGTH_1 = 9;
    const PATTERN_1 = "\\d{7}[a-wA-W]([a-iA-I]|W)";
    const LENGTH_2 = 8;
    const PATTERN_2 = "\\d{7}[a-wA-W]";

    public function validate(string $tin)
    {
        if (!$this->isFollowLength1($tin) && !$this->isFollowLength2($tin)) {
            return StatusCode::INVALID_LENGTH;
        }
        if (($this->isFollowLength1($tin) && !$this->isFollowPattern1($tin)) || ($this->isFollowLength2($tin) && !$this->isFollowPattern2($tin))) {
            return StatusCode::INVALID_PATTERN;
        }
        if (!$this->isFollowRules($tin)) {
            return StatusCode::INVALID_SYNTAX;
        }
        return StatusCode::VALID;
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
        $c9 = (strlen($tin) >= 9) ? self::letterToNumber($tin[8]) : 0;
        $c8 = $tin[7];
        $sum = $c9 * 9 + $c1 * 8 + $c2 * 7 + $c3 * 6 + $c4 * 5 + $c5 * 4 + $c6 * 3 + $c7 * 2;
        $remainderBy23 = $sum % 23;
        if ($remainderBy23 != 0) {
            return StringUtil::getAlphabeticalPosition($c8) == $remainderBy23;
        }
        return $c8 == 'W' || $c8 == 'w';
    }

    public static function letterToNumber(string $toConv)
    {
        if (!$toConv) {
            return 0;
        }
        if ($toConv == 'W' || $toConv == 'w') {
            return 0;
        }
        return StringUtil::getAlphabeticalPosition($toConv);
    }
}
