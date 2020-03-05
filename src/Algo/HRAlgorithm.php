<?php

namespace LeKoala\Tin\Algo;

use LeKoala\Tin\Util\StringUtil;

/**
 * Croatia
 */
class HRAlgorithm extends TINAlgorithm
{
    const LENGTH = 11;
    const PATTERN = "\\d{11}";

    public function validate(string $tin)
    {
        $str = StringUtil::clearString($tin);
        if (!StringUtil::isFollowLength($str, 11)) {
            return StatusCode::INVALID_LENGTH;
        }
        if (!StringUtil::isFollowPattern($str, self::PATTERN)) {
            return StatusCode::INVALID_PATTERN;
        }
        if (!$this->isFollowRules($str)) {
            return StatusCode::INVALID_SYNTAX;
        }
        return StatusCode::VALID;
    }

    public function isFollowRules(string $tin)
    {
        $sum = 0;
        $rest = 0;
        $sum = StringUtil::digitAt($tin, 0) + 10;
        for ($i = 1; $i < 11; $i++) {
            $rest = $sum % 10;
            $rest = (($rest == 0) ? 10 : $rest) * 2 % 11;
            $sum = $rest + StringUtil::digitAt($tin, $i);
        }
        $diff = 11 - $rest;
        $lastDigit = StringUtil::digitAt($tin, 10);
        return ($rest == 1 && $lastDigit == 0) || $lastDigit == $diff;
    }
}
