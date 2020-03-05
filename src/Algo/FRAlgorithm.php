<?php

namespace LeKoala\Tin\Algo;

use LeKoala\Tin\Util\StringUtil;

/**
 * France
 */
class FRAlgorithm extends TINAlgorithm
{
    const LENGTH_1 = 13;
    const PATTERN_1 = "[0-3]\\d{12}";

    public function validate(string $tin)
    {
        $tin = str_replace(' ', '', $tin);
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
        return StringUtil::isFollowLength($tin, self::LENGTH_1);
    }

    public function isFollowPattern(string $tin)
    {
        return StringUtil::isFollowPattern($tin, self::PATTERN_1);
    }

    public function isFollowRules(string $tin)
    {
        return $this->isFollowFranceRule1($tin);
    }

    public function isFollowFranceRule1(string $tin)
    {
        $number = floatval(StringUtil::substring($tin, 0, 10));
        $checkDigits = 0;
        $remainderBy511 = $number % 511;
        if ($remainderBy511 < 100) {
            if ($remainderBy511 < 10) {
                $checkDigits = intval(StringUtil::substring($tin, 12, 13));
            } else {
                $checkDigits = intval(StringUtil::substring($tin, 11, 13));
            }
        } else {
            $checkDigits = intval(StringUtil::substring($tin, 10, 13));
        }
        return $remainderBy511 == $checkDigits;
    }
}
