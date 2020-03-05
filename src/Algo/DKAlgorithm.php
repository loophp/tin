<?php

namespace LeKoala\Tin\Algo;

use LeKoala\Tin\Util\DateUtil;
use LeKoala\Tin\Util\StringUtil;

/**
 * Denmark
 */
class DKAlgorithm extends TINAlgorithm
{
    const LENGTH = 10;
    const PATTERN = "[0-3]\\d[0-1]\\d{3}\\d{4}";

    public function validate(string $tin)
    {
        $whithoutHyphen = str_replace("-", "", $tin);
        if (!$this->isFollowLength($whithoutHyphen)) {
            return StatusCode::INVALID_LENGTH;
        }
        if (!$this->isFollowPattern($whithoutHyphen) || !$this->isValidDate($whithoutHyphen)) {
            return StatusCode::INVALID_PATTERN;
        }
        if (!$this->isFollowRules($whithoutHyphen)) {
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
        return $this->isFollowDenmarkRule($tin);
    }

    /**
     * @link https://cpr.dk/cpr-systemet/personnumre-uden-kontrolciffer-modulus-11-kontrol/
     *
     * The CPR office has since 2007 given out social security numbers without the so called modulus 11 control.
     * The social security numbers without modulus 11 are completely valid
     * and are given out, as some birth years no longer have the capacity to provide them with modulus 11 control.
     *
     * We should not check modulus 11 control for the following birthdays:
     *
     * 1st of januar 1960
     * 1st of januar 1964
     * 1st of januar 1965
     * 1st of januar 1966
     * 1st of januar 1969
     * 1st of januar 1970
     * 1st of januar 1974
     * 1st of januar 1980
     * 1st of januar 1982
     * 1st of januar 1984
     * 1st of januar 1985
     * 1st of januar 1986
     * 1st of januar 1987
     * 1st of januar 1988
     * 1st of januar 1989
     * 1st of januar 1990
     * 1st of januar 1991
     * 1st of januar 1992
     *
     * @param string $tin
     * @return boolean
     */
    public function isFollowDenmarkRule(string $tin)
    {
        $serialNumber = intval(StringUtil::substring($tin, 6, 10));
        $dayOfBirth = intval(StringUtil::substring($tin, 0, 2));
        $monthOfBirth = intval(StringUtil::substring($tin, 2, 4));
        $yearOfBirth = intval(StringUtil::substring($tin, 4, 6));
        if ($yearOfBirth >= 37 && $yearOfBirth <= 57 && $serialNumber >= 5000 && $serialNumber <= 8999) {
            return false;
        }

        $excludedYears = [60, 64, 65, 66, 69, 70, 74, 80, 82, 84, 85, 86, 87, 88, 89, 90, 91, 92];
        if ($dayOfBirth == 1 && $monthOfBirth == 1 && in_array($yearOfBirth, $excludedYears)) {
            return true;
        }

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
        $sum = $c1 * 4 + $c2 * 3 + $c3 * 2 + $c4 * 7 + $c5 * 6 + $c6 * 5 + $c7 * 4 + $c8 * 3 + $c9 * 2;
        $remainderBy11 = $sum % 11;
        if ($remainderBy11 == 1) {
            return false;
        }
        if ($remainderBy11 == 0) {
            return $c10 == 0;
        }
        return $c10 == 11 - $remainderBy11;
    }

    private function isValidDate(string $tin)
    {
        $day = intval(StringUtil::substring($tin, 0, 2));
        $month = intval(StringUtil::substring($tin, 2, 4));
        $year = intval(StringUtil::substring($tin, 4, 6));
        return DateUtil::validate(1900 + $year, $month, $day) || DateUtil::validate(2000 + $year, $month, $day);
    }
}
