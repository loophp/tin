<?php

namespace LeKoala\Tin\Algo;

use LeKoala\Tin\Util\StringUtil;

/**
 * Cyprus
 */
class CYAlgorithm extends TINAlgorithm
{
    const LENGTH = 9;
    const PATTERN = "[0,9]\\d{7}[A-Z]";

    public function validate(string $tin)
    {
        if (!$this->isFollowLength($tin)) {
            return StatusCode::INVALID_LENGTH;
        }
        if (!$this->isFollowPattern($tin)) {
            return StatusCode::INVALID_PATTERN;
        }
        if (!$this->isFollowRules($tin)) {
            return StatusCode::INVALID_SYNTAX;
        }
        return StatusCode::VALID;
    }

    public function isFollowLength(string $tin)
    {
        return StringUtil::isFollowLength($tin, self::LENGTH);
    }

    public function isFollowPattern(string $tin)
    {
        return StringUtil::isFollowPattern($tin, self::PATTERN);
    }

    public function isFollowRules(string $tin)
    {
        $c1 = StringUtil::digitAt($tin, 0);
        $c2 = StringUtil::digitAt($tin, 1);
        $c3 = StringUtil::digitAt($tin, 2);
        $c4 = StringUtil::digitAt($tin, 3);
        $c5 = StringUtil::digitAt($tin, 4);
        $c6 = StringUtil::digitAt($tin, 5);
        $c7 = StringUtil::digitAt($tin, 6);
        $c8 = StringUtil::digitAt($tin, 7);
        $c9 = ord($tin[8]);
        $evenPositionNumbersSum = $c2 + $c4 + $c6 + $c8;
        $recodedSum = $this->recodeValue($c1) + $this->recodeValue($c3) + $this->recodeValue($c5) + $this->recodeValue($c7);
        $remainderBy26 = ($evenPositionNumbersSum + $recodedSum) % 26;
        return $remainderBy26 + 65 == $c9;
    }

    /**
     * @param integer $x
     * @return integer
     */
    public function recodeValue($x)
    {
        switch ($x) {
            case 0:
                return 1;
            case 1:
                return 0;
            case 2:
                return 5;
            case 3:
                return 7;
            case 4:
                return 9;
            case 5:
                return 13;
            case 6:
                return 15;
            case 7:
                return 17;
            case 8:
                return 19;
            case 9:
                return 21;
            default:
                return -1;
        }
    }
}
