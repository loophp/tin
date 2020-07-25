<?php

declare(strict_types=1);

namespace loophp\Tin\CountryHandler;

use const STR_PAD_LEFT;

/**
 * Spain.
 */
final class Spain extends CountryHandler
{
    /**
     * @var string
     */
    public const COUNTRYCODE = 'ES';

    /**
     * @var int
     */
    public const LENGTH = 9;

    /**
     * @var string
     */
    public const PATTERN_1 = '\\d{8}[a-zA-Z]';

    /**
     * @var string
     */
    public const PATTERN_2 = '[XYZKLMxyzklm]\\d{7}[a-zA-Z]';

    /**
     * @var array<int, string>
     */
    private static $tabConvertToChar = [
        'T', 'R', 'W', 'A', 'G',
        'M', 'Y', 'F', 'P', 'D',
        'X', 'B', 'N', 'J', 'Z',
        'S', 'Q', 'V', 'H', 'L',
        'C', 'K', 'E',
    ];

    public function getTIN(): string
    {
        return str_pad(parent::getTIN(), self::LENGTH, '0', STR_PAD_LEFT);
    }

    protected function hasValidPattern(string $tin): bool
    {
        return $this->isFollowPattern1($tin) || $this->isFollowPattern2($tin);
    }

    protected function hasValidRule(string $tin): bool
    {
        return ($this->isFollowPattern1($tin) && $this->isFollowRule1($tin)) ||
            ($this->isFollowPattern2($tin) && $this->isFollowRule2($tin));
    }

    private function getCharFromNumber(int $sum): string
    {
        return self::$tabConvertToChar[$sum - 1];
    }

    private function getNumberFromChar(string $m): int
    {
        switch ($m) {
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

    private function isFollowPattern1(string $tin): bool
    {
        return $this->matchPattern($tin, self::PATTERN_1);
    }

    private function isFollowPattern2(string $tin): bool
    {
        return $this->matchPattern($tin, self::PATTERN_2);
    }

    private function isFollowRule1(string $tin): bool
    {
        $number = (int) (mb_substr($tin, 0, mb_strlen($tin) - 1));
        $checkDigit = $tin[mb_strlen($tin) - 1];
        $remainderBy23 = $number % 23;
        $sum = $remainderBy23 + 1;

        return $this->getCharFromNumber($sum) === $checkDigit;
    }

    private function isFollowRule2(string $tin): bool
    {
        $c1 = (string) $this->getNumberFromChar($tin[0]);
        $number = (int) ($c1 . mb_substr($tin, 1, mb_strlen($tin)));
        $checkDigit = $tin[mb_strlen($tin) - 1];
        $remainderBy23 = $number % 23;
        $sum = $remainderBy23 + 1;

        return $this->getCharFromNumber($sum) === $checkDigit;
    }
}
