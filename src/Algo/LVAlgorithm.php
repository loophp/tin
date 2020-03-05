<?php

namespace LeKoala\Tin\Algo;

use LeKoala\Tin\Util\DateUtil;
use LeKoala\Tin\Util\StringUtil;

/**
 * Latvia
 */
class LVAlgorithm extends TINAlgorithm
{
    const LENGTH = 11;

    public function validate(string $tin)
    {
        if (!$this->isFollowLength($tin)) {
            return StatusCode::INVALID_LENGTH;
        }
        if (!$this->isValidDate($tin)) {
            return StatusCode::INVALID_PATTERN;
        }
        return StatusCode::VALID;
    }

    public function isFollowLength(string $tin)
    {
        return StringUtil::isFollowLength($tin, self::LENGTH);
    }

    /**
     * @param string $tin
     * @return boolean
     */
    private function isValidDate(string $tin)
    {
        $c1c2 = StringUtil::substring($tin, 0, 2);
        if ($c1c2 == '32') {
            return true;
        }
        $day = intval($c1c2);
        $month = intval(StringUtil::substring($tin, 2, 4));
        $year = intval(StringUtil::substring($tin, 4, 6));

        $y1 = DateUtil::validate(1900 + $year, $month, $day);
        $y2 = DateUtil::validate(2000 + $year, $month, $day);
        if (!$y1 || !$y2) {
            return false;
        }
        return true;
    }
}
