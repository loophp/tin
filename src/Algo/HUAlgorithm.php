<?php

namespace LeKoala\Tin\Algo;

use LeKoala\Tin\Util\StringUtil;

/**
 * Hungary
 */
class HUAlgorithm extends TINAlgorithm
{
    const LENGTH = 10;
    const PATTERN = "8\\d{9}";

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
        $c10 = StringUtil::digitAt($tin, 9);
        $sum = 0;
        for ($i = 0; $i < 9; $i++) {
            $c11 = intval(StringUtil::substring($tin, $i, $i + 1));
            $sum += $c11 * ($i + 1);
        }
        $remainderBy11 = $sum % 11;
        return $remainderBy11 == $c10;
    }
}
