<?php

namespace LeKoala\Tin\Algo;

use LeKoala\Tin\Util\DateUtil;
use LeKoala\Tin\Util\StringUtil;

/**
 * Czech Republic
 *
 * TODO: implement modulus check
 */
class CZAlgorithm extends TINAlgorithm
{
    const LENGTH_1 = 9;
    const LENGTH_2 = 10;

    public function validate(string $tin)
    {
        $normalizedTIN = str_replace("/", "", $tin);
        if (!$this->isFollowLength1($normalizedTIN) && !$this->isFollowLength2($normalizedTIN)) {
            return StatusCode::INVALID_LENGTH;
        }
        if (!$this->isValidDate($normalizedTIN)) {
            return StatusCode::INVALID_PATTERN;
        }
        return StatusCode::VALID;
    }

    public function isFollowLength1(string $tin)
    {
        return StringUtil::isFollowLength($tin, self::LENGTH_1);
    }

    public function isFollowLength2(string $tin)
    {
        return StringUtil::isFollowLength($tin, self::LENGTH_2);
    }

    /**
     * @param string $tin
     * @return boolean
     */
    private function isValidDate(string $tin)
    {
        $year = intval(StringUtil::substring($tin, 0, 2));
        $month = intval(StringUtil::substring($tin, 2, 4));
        // female have +50 in their month
        if ($month > 50) {
            $month = $month - 50;
        }
        // some people have +20 in their month
        if ($month > 12) {
            $month = $month - 20;
        }
        $day = intval(StringUtil::substring($tin, 4, 6));

        $y1 = DateUtil::validate(1900 + $year, $month, $day);
        $y2 = DateUtil::validate(2000 + $year, $month, $day);
        if (!$y1 || !$y2) {
            return false;
        }
        return true;
    }
}
