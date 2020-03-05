<?php

namespace LeKoala\Tin\Algo;

use LeKoala\Tin\Util\NumberUtil;
use LeKoala\Tin\Util\StringUtil;
use LeKoala\Tin\Exception\NegativeNumberException;

/**
 * Austria
 */
class ATAlgorithm extends TINAlgorithm
{
    const LENGTH = 9;
    const PATTERN = "\\d{9}";

    public function validate(string $tin)
    {
        $normalizedTIN = StringUtil::clearString($tin);
        if (!$this->isFollowLength($normalizedTIN)) {
            return StatusCode::INVALID_LENGTH;
        }
        if (!$this->isFollowPattern($normalizedTIN)) {
            return StatusCode::INVALID_PATTERN;
        }
        if (!$this->isFollowRules($normalizedTIN)) {
            return StatusCode::INVALID_SYNTAX;
        }
        return StatusCode::VALID;
    }

    public function isFollowRules(string $tin)
    {
        return self::LENGTH == strlen($tin) && $this->isFollowAustriaRule($tin);
    }

    public function isFollowLength(string $tin)
    {
        return StringUtil::isFollowLength($tin, self::LENGTH);
    }

    public function isFollowPattern(string $tin)
    {
        return StringUtil::isFollowPattern($tin, self::PATTERN);
    }

    public function isFollowAustriaRule(string $tin)
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
        try {
            $sum = $c1 + $c3 + $c5 + $c7 + NumberUtil::sumDigit($c2 * 2) + NumberUtil::sumDigit($c4 * 2) + NumberUtil::sumDigit($c6 * 2) + NumberUtil::sumDigit($c8 * 2);
            $check = NumberUtil::getUnit(100 - $sum);
            return $c9 == $check;
        } catch (NegativeNumberException $e) {
            return false;
        }
    }
}
