<?php

namespace LeKoala\Tin\Algo;

use LeKoala\Tin\Util\StringUtil;

/**
 * Slovakia
 */
class SKAlgorithm extends TINAlgorithm
{
    const LENGTH = 10;

    public function validate(string $tin)
    {
        $str = StringUtil::clearString($tin);
        if (!$this->isFollowLength($str)) {
            return StatusCode::INVALID_LENGTH;
        }
        return StatusCode::VALID;
    }

    public function isFollowLength(string $tin)
    {
        $c1c2 = StringUtil::substring($tin, 0, 2);
        if ($c1c2 < 54) {
            return StringUtil::isFollowLength($tin, self::LENGTH - 1);
        }
        return StringUtil::isFollowLength($tin, self::LENGTH);
    }
}
