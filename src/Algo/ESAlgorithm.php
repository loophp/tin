<?php

namespace LeKoala\Tin\Algo;

use LeKoala\Tin\Util\StringUtil;

/**
 * Spain
 */
class ESAlgorithm extends TINAlgorithm
{
    const LENGTH = 9;
    const PATTERN_1 = "\\d{8}[a-zA-Z]";
    const PATTERN_2 = "[XYZKLMxyzklm]\\d{7}[a-zA-Z]";

    /**
     * @var array
     */
    private static $tabConvertToChar = ['T', 'R', 'W', 'A', 'G', 'M', 'Y', 'F', 'P', 'D', 'X', 'B', 'N', 'J', 'Z', 'S', 'Q', 'V', 'H', 'L', 'C', 'K', 'E'];

    public function validate(string $tin)
    {
        $normalizedTIN = $this->fillWith0($tin);
        if (!$this->isFollowLength($normalizedTIN)) {
            return StatusCode::INVALID_LENGTH;
        }
        if (!$this->isFollowPattern1($normalizedTIN) && !$this->isFollowPattern2($normalizedTIN)) {
            return StatusCode::INVALID_PATTERN;
        }
        if (!$this->isFollowRules($normalizedTIN)) {
            return StatusCode::INVALID_SYNTAX;
        }
        return StatusCode::VALID;
    }

    public function isFollowLength(string $tin)
    {
        return StringUtil::isFollowLength($tin, self::LENGTH);
    }

    public function isFollowPattern1(string $tin)
    {
        return StringUtil::isFollowPattern($tin, self::PATTERN_1);
    }

    public function isFollowPattern2(string $tin)
    {
        return StringUtil::isFollowPattern($tin, self::PATTERN_2);
    }

    public function isFollowRules(string $tin)
    {
        return ($this->isFollowPattern1($tin) && $this->isFollowESRule1($tin)) || ($this->isFollowPattern2($tin) && $this->isFollowESRule2($tin));
    }

    private function isFollowESRule1(string $tin)
    {
        $number = intval(StringUtil::substring($tin, 0, strlen($tin) - 1));
        $checkDigit = $tin[strlen($tin) - 1];
        $remainderBy23 = $number % 23;
        $sum = $remainderBy23 + 1;
        return strtoupper($checkDigit) == $this->getCharFromNumber($sum);
    }

    private function isFollowESRule2(string $tin)
    {
        $c1 = StringUtil::forDigit($this->getNumberFromChar($tin[0]), 10);
        $number = intval($c1 . StringUtil::substring($tin, 1, strlen($tin) - 1));
        $checkDigit =  $tin[strlen($tin) - 1];
        $remainderBy23 = $number % 23;
        $sum = $remainderBy23 + 1;

        return strtoupper($checkDigit) == $this->getCharFromNumber($sum);
    }

    protected function getNumberFromChar($m)
    {
        switch (strtoupper($m)) {
            case 'K':
            case 'L':
            case 'M':
            case 'X':
                return 0;
            case 'Y':
                return 1;
            case 'Z':
                return 2;
            default:
                return -1;
        }
    }

    private function getCharFromNumber($sum)
    {
        return self::$tabConvertToChar[$sum - 1];
    }

    private function fillWith0(string $tin)
    {
        return StringUtil::fillWith0UntilLength($tin, self::LENGTH);
    }
}
