<?php

namespace LeKoala\Tin\Algo;

use LeKoala\Tin\Util\StringUtil;

/**
 * United Kingdom
 * 10 numerals = UTR: Unique Taxpayer Reference
 * 9 chars=  NINO: National Insurance Number
 */
class UKAlgorithm extends TINAlgorithm
{
    const LENGTH_1 = 10;
    const PATTERN_1 = "\\d{10}";
    const LENGTH_2 = 9;
    const PATTERN_2 = "[a-ceg-hj-pr-tw-zA-CEG-HJ-PR-TW-Z][a-ceg-hj-npr-tw-zA-CEG-HJ-NPR-TW-Z]\\d{6}[abcdABCD ]";

    public function validate(string $tin)
    {
        $normalizedTIN = str_replace("/", "", $tin);
        if (strlen($tin) == 8) {
            $normalizedTIN += " ";
        }
        if (!$this->isFollowLength1($normalizedTIN) && !$this->isFollowLength2($normalizedTIN)) {
            return StatusCode::INVALID_LENGTH;
        }
        if (($this->isFollowLength1($normalizedTIN) && !$this->isFollowPattern1($normalizedTIN)) || ($this->isFollowLength2($normalizedTIN) && !$this->isFollowPattern2($normalizedTIN))) {
            return StatusCode::INVALID_PATTERN;
        }
        return StatusCode::VALID;
    }

    public function isFollowLength1(string $tin)
    {
        return StringUtil::isFollowLength($tin, self::LENGTH_1);
    }

    public function isFollowPattern1(string $tin)
    {
        return StringUtil::isFollowPattern($tin, self::PATTERN_1);
    }

    public function isFollowLength2(string $tin)
    {
        return StringUtil::isFollowLength($tin, self::LENGTH_2);
    }

    public function isFollowPattern2(string $tin)
    {
        return StringUtil::isFollowPattern($tin, self::PATTERN_2) && $this->isFollowStructureSubRule2($tin);
    }

    public function isFollowStructureSubRule2(string $tin)
    {
        $c1c2 = strtoupper(StringUtil::substring($tin, 0, 2));
        return !("GB" == $c1c2) && !("NK" == $c1c2) && !("TN" == $c1c2) && !("ZZ" == $c1c2);
    }
}
