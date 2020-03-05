<?php

namespace LeKoala\Tin\Algo;

use LeKoala\Tin\Util\DateUtil;
use LeKoala\Tin\Util\NumberUtil;
use LeKoala\Tin\Util\StringUtil;
use LeKoala\Tin\Exception\NegativeNumberException;

/**
 * Luxembourg
 */
class LUAlgorithm extends TINAlgorithm
{
    const LENGTH_1 = 13;
    const PATTERN_1 = "(1[89]|20)\\d{2}(0[1-9]|1[012])(0[1-9]|[1-2][0-9]|3[0-1])\\d{5}";
    private static $D = [
        [0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
        [1, 2, 3, 4, 0, 6, 7, 8, 9, 5],

        [2, 3, 4, 0, 1, 7, 8, 9, 5, 6],
        [3, 4, 0, 1, 2, 8, 9, 5, 6, 7],
        [4, 0, 1, 2, 3, 9, 5, 6, 7, 8],
        [5, 9, 8, 7, 6, 0, 4, 3, 2, 1],
        [6, 5, 9, 8, 7, 1, 0, 4, 3, 2],
        [7, 6, 5, 9, 8, 2, 1, 0, 4, 3],
        [8, 7, 6, 5, 9, 3, 2, 1, 0, 4],
        [9, 8, 7, 6, 5, 4, 3, 2, 1, 0]
    ];
    private static $P = [
        [0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
        [1, 5, 7, 6, 2, 8, 3, 0, 9, 4],
        [5, 8, 0, 3, 7, 9, 6, 1, 4, 2],
        [8, 9, 1, 6, 0, 4, 3, 5, 2, 7],
        [9, 4, 5, 3, 1, 2, 6, 8, 7, 0],
        [4, 2, 8, 6, 5, 7, 3, 9, 0, 1],
        [2, 7, 9, 3, 8, 0, 6, 4, 1, 5],
        [7, 0, 4, 6, 9, 1, 3, 2, 5, 8]
    ];

    public function validate(string $tin)
    {
        if (!$this->isFollowLength1($tin)) {
            return StatusCode::INVALID_LENGTH;
        }
        if (!$this->isFollowPattern1($tin) || !$this->isValidDate($tin)) {
            return StatusCode::INVALID_PATTERN;
        }
        if (!$this->isFollowRules($tin)) {
            return StatusCode::INVALID_SYNTAX;
        }
        return StatusCode::VALID;
    }

    public function isFollowRules(string $tin)
    {
        return $this->isFollowLuxembourgRule1($tin) && $this->isFollowLuxembourgRule2($tin);
    }

    public function isFollowLength1(string $tin)
    {
        return StringUtil::isFollowLength($tin, self::LENGTH_1);
    }

    public function isFollowPattern1(string $tin)
    {
        return StringUtil::isFollowPattern($tin, self::PATTERN_1);
    }

    public function isFollowLuxembourgRule1(string $tin)
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
        $c12 = StringUtil::digitAt($tin, 11);
        try {
            $sum = $c2 + $c4 + $c6 + $c8 + $c10 + $c12
                + NumberUtil::sumDigit($c1 * 2)
                + NumberUtil::sumDigit($c3 * 2)
                + NumberUtil::sumDigit($c5 * 2)
                + NumberUtil::sumDigit($c7 * 2)
                + NumberUtil::sumDigit($c9 * 2)
                + NumberUtil::sumDigit($c11 * 2);
            $remainderBy10 = $sum % 10;
            return $remainderBy10 == 0;
        } catch (NegativeNumberException $e) {
            return false;
        }
    }

    public function isFollowLuxembourgRule2(string $tin)
    {
        $listNumbers = [];
        for ($i = 12; $i >= 0; $i--) {
            if ($i != 11) {
                $listNumbers[] = StringUtil::digitAt($tin, $i);
            }
        }
        $check = 0;
        for ($j = 0; $j < count($listNumbers); $j++) {
            $item = $listNumbers[$j];
            $p = self::$P[$j % 8][$item];
            $check = self::$D[$check][$p];
        }
        return $check == 0;
    }

    private function isValidDate(string $tin)
    {
        $year = intval(StringUtil::substring($tin, 0, 4));
        $month = intval(StringUtil::substring($tin, 4, 6));
        $day = intval(StringUtil::substring($tin, 6, 8));
        return DateUtil::validate($year, $month, $day);
    }
}
