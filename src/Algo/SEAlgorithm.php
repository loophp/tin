<?php

namespace LeKoala\Tin\Algo;

use LeKoala\Tin\Util\DateUtil;
use LeKoala\Tin\Util\NumberUtil;
use LeKoala\Tin\Util\StringUtil;
use LeKoala\Tin\Exception\NegativeNumberException;

/**
 * Sweden
 */
class SEAlgorithm extends TINAlgorithm
{
    const LENGTH_1_AND_2 = 10;
    const PATTERN_1 = "\\d{2}[0-1]\\d[0-3]\\d{5}";
    const PATTERN_2 = "\\d{2}[0-1]\\d[6-9]\\d{5}";
    const LENGTH_3_AND_4 = 12;
    const PATTERN_3 = "(1[89]|20)\\d{2}(0[1-9]|1[012])(0[1-9]|[1-2][0-9]|3[0-1])\\d{4}";
    const PATTERN_4 = "(1[89]|20)\\d{2}(0[1-9]|1[012])(6[1-9]|[7-8][0-9]|9[0-1])\\d{4}";

    public function validate(string $tin)
    {
        $normalizedTIN = str_replace("-", "", $tin);
        $normalizedTIN = str_replace("+", "", $normalizedTIN);
        if (!$this->isFollowLength1And2($normalizedTIN) && !$this->isFollowLength3And4($normalizedTIN)) {
            return StatusCode::INVALID_LENGTH;
        }
        if (!$this->isFollowPatterns($normalizedTIN)) {
            return StatusCode::INVALID_PATTERN;
        }
        if (!$this->isFollowRules($normalizedTIN)) {
            return StatusCode::INVALID_SYNTAX;
        }
        return StatusCode::VALID;
    }

    public function isFollowPatterns(string $tin)
    {
        return $this->isFollowPatternAndIsValidDate($tin)
            || $this->isFollowPattern2AndIsValidDate2($tin)
            || $this->isFollowPattern3AndIsValidDate3($tin)
            || $this->isFollowPattern4AndIsValidDate4($tin);
    }

    public function isFollowPatternAndIsValidDate(string $tin)
    {
        return $this->isFollowPattern($tin) && $this->isValidDate($tin);
    }

    public function isFollowPattern2AndIsValidDate2(string $tin)
    {
        return $this->isFollowPattern2($tin) && $this->isValidDate2($tin);
    }

    public function isFollowPattern3AndIsValidDate3(string $tin)
    {
        return $this->isFollowPattern3($tin) && $this->isValidDate3($tin);
    }

    public function isFollowPattern4AndIsValidDate4(string $tin)
    {
        return $this->isFollowPattern4($tin) && $this->isValidDate4($tin);
    }

    public function isFollowRules(string $tin)
    {
        return (intval("10") == strlen($tin)
            && $this->isFollowSwedenRule1And2($tin))
            || (intval("12") == strlen($tin)
                && $this->isFollowSwedenRule3And4($tin));
    }

    public function isFollowLength1And2(string $tin)
    {
        return StringUtil::isFollowLength($tin, self::LENGTH_1_AND_2);
    }

    public function isFollowLength3And4(string $tin)
    {
        return StringUtil::isFollowLength($tin, self::LENGTH_3_AND_4);
    }

    public function isFollowPattern(string $tin)
    {
        return StringUtil::isFollowPattern($tin, self::PATTERN_1);
    }

    public function isFollowPattern2(string $tin)
    {
        return StringUtil::isFollowPattern($tin, self::PATTERN_2);
    }

    public function isFollowPattern3(string $tin)
    {
        return StringUtil::isFollowPattern($tin, self::PATTERN_3);
    }

    public function isFollowPattern4(string $tin)
    {
        return StringUtil::isFollowPattern($tin, self::PATTERN_4);
    }

    public function isFollowSwedenRule1And2(string $tin)
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
        try {
            $sum = $c2 + $c4 + $c6 + $c8
                + NumberUtil::sumDigit($c1 * 2)
                + NumberUtil::sumDigit($c3 * 2)
                + NumberUtil::sumDigit($c5 * 2)
                + NumberUtil::sumDigit($c7 * 2)
                + NumberUtil::sumDigit($c9 * 2);
            $check = 10 - NumberUtil::getUnit($sum);
            if ($check != 10) {
                return $c10 == $check;
            }
            return $c10 == 0;
        } catch (NegativeNumberException $e) {
            return false;
        }
    }

    public function isFollowSwedenRule3And4(string $tin)
    {
        $c3 = StringUtil::digitAt($tin, 2);
        $c4 = StringUtil::digitAt($tin, 3);
        $c5 = StringUtil::digitAt($tin, 4);
        $c6 = StringUtil::digitAt($tin, 5);
        $c7 = StringUtil::digitAt($tin, 6);
        $c8 = StringUtil::digitAt($tin, 7);
        $c9 = StringUtil::digitAt($tin, 8);
        $c10 = StringUtil::digitAt($tin, 9);
        $c11 = StringUtil::digitAt($tin, 10);
        $c12 = StringUtil::digitAt($tin, 11);
        try {
            $sum = $c4 + $c6 + $c8 + $c10
                + NumberUtil::sumDigit($c3 * 2)
                + NumberUtil::sumDigit($c5 * 2)
                + NumberUtil::sumDigit($c7 * 2)
                + NumberUtil::sumDigit($c9 * 2)
                + NumberUtil::sumDigit($c11 * 2);
            $check = 10 - NumberUtil::getUnit($sum);
            if ($check != 10) {
                return $c12 == $check;
            }
            return $c12 == 0;
        } catch (NegativeNumberException $e) {
            return false;
        }
    }

    private function isValidDate(string $tin)
    {
        $year = intval(StringUtil::substring($tin, 0, 2));
        $month = intval(StringUtil::substring($tin, 2, 4));
        $day = intval(StringUtil::substring($tin, 4, 6));
        return DateUtil::validate(1900 + $year, $month, $day) || DateUtil::validate(2000 + $year, $month, $day);
    }

    private function isValidDate2(string $tin)
    {
        $year = intval(StringUtil::substring($tin, 0, 2));
        $month = intval(StringUtil::substring($tin, 2, 4));
        $day = intval(StringUtil::substring($tin, 4, 6));
        return DateUtil::validate(1900 + $year, $month, $day - 60) || DateUtil::validate(2000 + $year, $month, $day - 60);
    }

    private function isValidDate3(string $tin)
    {
        $year = intval(StringUtil::substring($tin, 0, 4));
        $month = intval(StringUtil::substring($tin, 4, 6));
        $day = intval(StringUtil::substring($tin, 6, 8));
        return DateUtil::validate($year, $month, $day);
    }

    private function isValidDate4(string $tin)
    {
        $year = intval(StringUtil::substring($tin, 0, 4));
        $month = intval(StringUtil::substring($tin, 4, 6));
        $day = intval(StringUtil::substring($tin, 6, 8));
        return DateUtil::validate($year, $month, $day - 60);
    }
}
