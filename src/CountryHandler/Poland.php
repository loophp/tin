<?php

declare(strict_types=1);

namespace loophp\Tin\CountryHandler;

/**
 * Poland.
 */
final class Poland extends CountryHandler
{
    /**
     * @var string
     */
    public const COUNTRYCODE = 'PL';

    /**
     * @var int
     */
    public const LENGTH_1 = 10;

    /**
     * @var int
     */
    public const LENGTH_2 = 11;

    /**
     * @var string
     */
    public const PATTERN_1 = '\d{10}';

    /**
     * @var string
     */
    public const PATTERN_2 = '\d{11}';

    protected function hasValidDateWhenPattern2(string $tin): bool
    {
        $year = (int) (substr($tin, 0, 2));
        $month = (int) (substr($tin, 2, 2));
        $day = (int) (substr($tin, 4, 2));

        if (1 <= $month && 12 >= $month) {
            return checkdate($month, $day, 1900 + $year);
        }

        if (21 <= $month && 32 >= $month) {
            return checkdate($month - 20, $day, 2000 + $year);
        }

        if (41 <= $month && 52 >= $month) {
            return checkdate($month - 40, $day, 2100 + $year);
        }

        if (61 <= $month && 72 >= $month) {
            return checkdate($month - 60, $day, 2200 + $year);
        }

        return 81 <= $month && 92 >= $month && checkdate($month - 80, $day, 1800 + $year);
    }

    protected function hasValidLength(string $tin): bool
    {
        return $this->isFollowLength1($tin) || $this->isFollowLength2($tin);
    }

    protected function hasValidPattern(string $tin): bool
    {
        return $this->isFollowLength1AndPattern1($tin) || $this->isFollowLength2AndPattern2AndIsValidDate($tin);
    }

    protected function hasValidRule(string $tin): bool
    {
        return ($this->isFollowLength1($tin) && $this->isFollowRulePoland1($tin))
            || ($this->isFollowLength2($tin) && $this->isFollowRulePoland2($tin));
    }

    private function isFollowLength1(string $tin): bool
    {
        return $this->matchLength($tin, self::LENGTH_1);
    }

    private function isFollowLength1AndPattern1(string $tin): bool
    {
        return $this->isFollowLength1($tin) && $this->isFollowPattern1($tin);
    }

    private function isFollowLength2(string $tin): bool
    {
        return $this->matchLength($tin, self::LENGTH_2);
    }

    private function isFollowLength2AndPattern2AndIsValidDate(string $tin): bool
    {
        return $this->isFollowLength2($tin) && $this->isFollowPattern2($tin) && $this->hasValidDateWhenPattern2($tin);
    }

    private function isFollowPattern1(string $tin): bool
    {
        return $this->matchPattern($tin, self::PATTERN_1);
    }

    private function isFollowPattern2(string $tin): bool
    {
        return $this->matchPattern($tin, self::PATTERN_2);
    }

    private function isFollowRulePoland1(string $tin): bool
    {
        $map = [
            6,
            5,
            7,
            2,
            3,
            4,
            5,
            6,
            7,
        ];

        $sum = 0;

        foreach ($map as $key => $weight) {
            $sum += $this->digitAt($tin, $key) * $weight;
        }

        $remainderBy11 = $sum % 11;

        if (10 === $remainderBy11) {
            return false;
        }

        // @todo: Optimize that
        return $this->digitAt($tin, 9) === $remainderBy11;
    }

    private function isFollowRulePoland2(string $tin): bool
    {
        $map = [
            1,
            3,
            7,
            9,
            1,
            3,
            7,
            9,
            1,
            3,
        ];

        $sum = 0;

        foreach ($map as $key => $weight) {
            $sum += $this->digitAt($tin, $key) * $weight;
        }

        $lastDigit = $sum % 10;

        return 10 - $lastDigit === $this->digitAt($tin, 10);
    }
}
