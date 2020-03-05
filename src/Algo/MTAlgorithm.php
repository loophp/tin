<?php

namespace LeKoala\Tin\Algo;

use LeKoala\Tin\Util\StringUtil;

/**
 * Malta
 */
class MTAlgorithm extends TINAlgorithm
{
    const LENGTH = 8;

    public function validate(string $tin)
    {
        $normalizedTIN = StringUtil::fillWith0UntilLength($tin, self::LENGTH);
        if (!$this->isFollowLength($normalizedTIN)) {
            return StatusCode::INVALID_LENGTH;
        }
        if (!$this->isFollowMaltaRule($normalizedTIN)) {
            return StatusCode::INVALID_PATTERN;
        }
        return StatusCode::VALID;
    }

    public function isFollowLength(string $tin)
    {
        return StringUtil::isFollowLength($tin, self::LENGTH);
    }

    public function isFollowMaltaRule(string $tin)
    {
        $c8 = $tin[7];
        $valid = ['M', 'G', 'A', 'P', 'L', 'H', 'B', 'Z'];
        if (!in_array($c8, $valid)) {
            return false;
        }
        return true;
    }
}
