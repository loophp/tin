<?php

namespace LeKoala\Tin\Algo;

use LeKoala\Tin\Util\StringUtil;

/**
 * Germany
 */
class DEAlgorithm extends TINAlgorithm
{
    const LENGTH_1 = 11;
    const PATTERN_1 = "[1-9]\\d{10}";
    const LENGTH_2 = 11;
    const PATTERN_2 = "[1-9]\\d{10}";

    public function validate(string $tin)
    {
        $normalizedTIN = str_replace("/", "", $tin);
        if (!$this->isFollowLength($normalizedTIN)) {
            return StatusCode::INVALID_LENGTH;
        }
        if ($this->isFollowLength($normalizedTIN) && !$this->isFollowPattern($normalizedTIN)) {
            return StatusCode::INVALID_PATTERN;
        }
        if (!$this->isFollowRules($normalizedTIN)) {
            return StatusCode::INVALID_SYNTAX;
        }
        return StatusCode::VALID;
    }

    public function isFollowLength(string $tin)
    {
        return $this->isFollowLength1($tin) || $this->isFollowLength2($tin);
    }

    public function isFollowLength1(string $tin)
    {
        return StringUtil::isFollowLength($tin, self::LENGTH_1);
    }

    public function isFollowLength2(string $tin)
    {
        return StringUtil::isFollowLength($tin, self::LENGTH_2);
    }

    public function isFollowPattern(string $tin)
    {
        return $this->isFollowPattern1($tin) || $this->isFollowPattern2($tin);
    }

    public function isFollowPattern1(string $tin)
    {
        if (!StringUtil::isFollowPattern($tin, self::PATTERN_1)) {
            return false;
        }
        $tab = [];
        $pos = [];
        for ($i = 0; $i < 10; $i++) {
            $tab[$i] = StringUtil::digitAt($tin, $i);
            $pos[$i] = 0;
        }
        for ($j = 0; $j < 10; $j++) {
            $pos[$tab[$j]]++;
        }
        $isEncounteredTwice2 = false;
        $isEncountered0 = false;
        for ($k = 0; $k < 10; $k++) {
            if ($pos[$k] == 2) {
                if ($isEncounteredTwice2) {
                    return false;
                }
                $isEncounteredTwice2 = true;
            }
            if ($pos[$k] == 0) {
                if ($isEncountered0) {
                    return false;
                }
                $isEncountered0 = true;
            }
        }
        return $isEncountered0;
    }

    public function isFollowPattern2(string $tin)
    {
        if (!StringUtil::isFollowPattern($tin, self::PATTERN_2)) {
            return false;
        }
        $tab = [];
        $pos = [];
        for ($i = 0; $i < 10; $i++) {
            $tab[$i] = StringUtil::digitAt($tin, $i);
            $pos[$i] = 0;
        }
        for ($i = 0; $i < 8; $i++) {
            if ($tab[$i] == $tab[$i + 1] && $tab[$i + 1] == $tab[$i + 2]) {
                return false;
            }
        }
        for ($j = 0; $j < 10; $j++) {
            $pos[$tab[$j]]++;
        }
        $isEncounteredTwice2 = false;
        $isEncounteredThrice3 = false;
        for ($k = 0; $k < 10; $k++) {
            if ($pos[$k] > 3) {
                return false;
            }
            if ($pos[$k] == 3) {
                if ($isEncounteredThrice3) {
                    return false;
                }
                $isEncounteredThrice3 = true;
            }
            if ($pos[$k] == 2) {
                if ($isEncounteredTwice2) {
                    return false;
                }
                $isEncounteredTwice2 = true;
            }
        }
        return $isEncounteredThrice3 || $isEncounteredTwice2;
    }

    public function isFollowRules(string $tin)
    {
        return (self::LENGTH_1 == strlen($tin) && $this->isFollowRuleGermany1($tin)) || $this->isFollowRuleGermany2($tin);
    }

    public function isFollowRuleGermany1(string $tin)
    {
        $c1 = StringUtil::digitAt($tin, 0);
        $c2 = [];
        for ($i = 0; $i < 9; $i++) {
            $c2[$i] = StringUtil::digitAt($tin, $i + 1);
        }
        $result = ($c1 + 10) % 10;
        if ($result == 0) {
            $result = 10;
        }
        $result *= 2;
        $x = $result % 11;
        for ($j = 0; $j < 9; $j++) {
            $x = ($x + $c2[$j]) % 10;
            if ($x == 0) {
                $x = 10;
            }
            $x *= 2;
            $x %= 11;
        }
        $c3 = StringUtil::digitAt($tin, 10);
        $total = 11 - $x;
        if ($total == 10) {
            return $c3 == 0;
        }
        return $total == $c3;
    }

    public function isFollowRuleGermany2(string $tin)
    {
        return StringUtil::digitAt($tin, 10) == $this->calculateCheckDigit($tin);
    }

    public function calculateCheckDigit(string $idnrString)
    {
        $ten = 10;
        $eleven = 11;
        $chars = str_split($idnrString);
        $remainder_mod_ten = 0;
        $remainder_mod_eleven = 10;
        $digit = 0;
        for ($length = strlen($idnrString), $counter = 0; $counter < $length - 1; $counter++) {
            $digit = intval($chars[$counter]);
            $remainder_mod_ten = ($digit + $remainder_mod_eleven) % 10;
            if ($remainder_mod_ten == 0) {
                $remainder_mod_ten = 10;
            }
            $remainder_mod_eleven = 2 * $remainder_mod_ten % 11;
        }
        $digit = 11 - $remainder_mod_eleven;
        if ($digit == 10) {
            $digit = 0;
        }
        return $digit;
    }
}
