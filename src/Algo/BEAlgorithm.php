<?php

namespace LeKoala\Tin\Algo;

use LeKoala\Tin\Util\DateUtil;
use LeKoala\Tin\Util\StringUtil;

/**
 * Belgium
 */
class BEAlgorithm extends TINAlgorithm
{
    const LENGTH = 11;
    const PATTERN = "\\d{2}[0-1]\\d[0-3]\\d{6}";

    /**
     * @var integer
     */
    protected $resultDateValidation;

    public function validate(string $tin)
    {
        $str = StringUtil::clearString($tin);
        if (!$this->isFollowLength($str)) {
            return StatusCode::INVALID_LENGTH;
        }

        $this->resultDateValidation = $this->isValidDate($str);
        if (!$this->isFollowPattern($str) || $this->resultDateValidation == 0) {
            return StatusCode::INVALID_PATTERN;
        }
        if (!$this->isFollowRules($str)) {
            return StatusCode::INVALID_SYNTAX;
        }
        return StatusCode::VALID;
    }


    /**
     * @return integer
     */
    public function getResultDateValidation()
    {
        return $this->resultDateValidation;
    }

    /**
     * @param integer $resultDateValidation
     */
    public function setResultDateValidation($resultDateValidation)
    {
        $this->resultDateValidation = $resultDateValidation;
    }

    public function isFollowRules(string $tin)
    {
        return $this->isFollowBelgiumRule1AndIsDateValid($tin) || $this->isFollowBelgiumRule2AndIsDateValid($tin);
    }

    public function isFollowBelgiumRule1AndIsDateValid(string $tin)
    {
        $dateValid = ($this->resultDateValidation == 1 || $this->resultDateValidation == 3);
        return $this->isFollowBelgiumRule1($tin) && $dateValid;
    }

    public function isFollowBelgiumRule2AndIsDateValid(string $tin)
    {
        $dateValid = $this->resultDateValidation >= 2;
        return $this->isFollowBelgiumRule2($tin) && $dateValid;
    }

    public function isFollowLength(string $tin)
    {
        return StringUtil::isFollowLength($tin, self::LENGTH);
    }

    public function isFollowPattern(string $tin)
    {
        return StringUtil::isFollowPattern($tin, self::PATTERN);
    }

    public function isFollowBelgiumRule1(string $tin)
    {
        $divisionRemainderBy97 = intval(StringUtil::substring($tin, 0, 9)) % 97;
        return 97 - $divisionRemainderBy97 == intval(StringUtil::substring($tin, 9, 11));
    }

    public function isFollowBelgiumRule2(string $tin)
    {
        $divisionRemainderBy97 = floatval(2 + StringUtil::substring($tin, 0, 9)) % 97;
        return 97 - $divisionRemainderBy97 == intval(StringUtil::substring($tin, 9, 11));
    }

    /**
     * @param string $tin
     * @return integer
     */
    private function isValidDate(string $tin)
    {
        $year = intval(StringUtil::substring($tin, 0, 2));
        $month = intval(StringUtil::substring($tin, 2, 4));
        $day = intval(StringUtil::substring($tin, 4, 6));

        $y1 = DateUtil::validate(1900 + $year, $month, $day);
        $y2 = DateUtil::validate(2000 + $year, $month, $day);
        if ($day == 0 || $month == 0 || $y1 && $y2) {
            return 3;
        }
        if ($y1) {
            return 1;
        }
        if ($y2) {
            return 2;
        }
        return 0;
    }
}
