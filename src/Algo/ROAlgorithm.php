<?php

namespace LeKoala\Tin\Algo;

use LeKoala\Tin\Util\DateUtil;
use LeKoala\Tin\Util\StringUtil;

/**
 * Romania
 */
class ROAlgorithm extends TINAlgorithm
{
    const LENGTH = 13;

    public function validate(string $tin)
    {
        if (!$this->isFollowLength($tin)) {
            return StatusCode::INVALID_LENGTH;
        }
        if (!$this->isFollowPattern($tin)) {
            return StatusCode::INVALID_PATTERN;
        }
        return StatusCode::VALID;
    }

    public function isFollowLength(string $tin)
    {
        return StringUtil::isFollowLength($tin, self::LENGTH);
    }

    public function isFollowPattern(string $tin)
    {
        return $this->isValidDate($tin) && $this->isFollowRomanianRule($tin);
    }

    private function isFollowRomanianRule(string $tin)
    {
        $c1 = intval($tin[0]);

        if ($c1 == 0) {
            return false;
        }

        $county = intval(StringUtil::substring($tin, 7, 9));

        if ($county > 47 && $county != 51 && $county != 52) {
            return false;
        }

        return true;
    }

    /**
     * @param string $tin
     * @return boolean
     */
    private function isValidDate(string $tin)
    {
        $year = intval(StringUtil::substring($tin, 1, 3));
        $month = intval(StringUtil::substring($tin, 3, 5));
        $day = intval(StringUtil::substring($tin, 5, 7));

        $y1 = DateUtil::validate(1900 + $year, $month, $day);
        $y2 = DateUtil::validate(2000 + $year, $month, $day);
        if (!$y1 || !$y2) {
            return false;
        }
        return true;
    }
}
