<?php

declare(strict_types=1);

namespace LeKoala\Tin\CountryHandler;

use function strlen;

/**
 * Sweden.
 */
final class Sweden extends CountryHandler
{
    /**
     * @var string
     */
    public const COUNTRYCODE = 'SE';

    /**
     * @var int
     */
    public const LENGTH_1_AND_2 = 10;

    /**
     * @var int
     */
    public const LENGTH_3_AND_4 = 12;

    /**
     * @var string
     */
    public const PATTERN_1 = '\\d{2}[0-1]\\d[0-3]\\d{5}';

    /**
     * @var string
     */
    public const PATTERN_2 = '\\d{2}[0-1]\\d[6-9]\\d{5}';

    /**
     * @var string
     */
    public const PATTERN_3 = '(1[89]|20)\\d{2}(0[1-9]|1[012])(0[1-9]|[1-2][0-9]|3[0-1])\\d{4}';

    /**
     * @var string
     */
    public const PATTERN_4 = '(1[89]|20)\\d{2}(0[1-9]|1[012])(6[1-9]|[7-8][0-9]|9[0-1])\\d{4}';

    protected function hasValidLength(string $tin): bool
    {
        return $this->isFollowLength1And2($tin) || $this->isFollowLength3And4($tin);
    }

    protected function hasValidPattern(string $tin): bool
    {
        return $this->isFollowPattern1AndIsValidDate1($tin)
            || $this->isFollowPattern2AndIsValidDate2($tin)
            || $this->isFollowPattern3AndIsValidDate3($tin)
            || $this->isFollowPattern4AndIsValidDate4($tin);
    }

    protected function hasValidRule(string $tin): bool
    {
        return ((int) '10' === strlen($tin)
            && $this->isFollowSwedenRule1And2($tin))
            || ((int) '12' === strlen($tin)
                && $this->isFollowSwedenRule3And4($tin));
    }

    private function hasValidDate1(string $tin): bool
    {
        $year = (int) (substr($tin, 0, 2));
        $month = (int) (substr($tin, 2, 2));
        $day = (int) (substr($tin, 4, 2));

        return checkdate($month, $day, 1900 + $year) || checkdate($month, $day, 2000 + $year);
    }

    private function hasValidDate2(string $tin): bool
    {
        $year = (int) (substr($tin, 0, 2));
        $month = (int) (substr($tin, 2, 2));
        $day = (int) (substr($tin, 4, 2));

        return checkdate($month, $day - 60, 1900 + $year) || checkdate($month, $day - 60, 2000 + $year);
    }

    private function hasValidDate3(string $tin): bool
    {
        $year = (int) (substr($tin, 0, 4));
        $month = (int) (substr($tin, 4, 2));
        $day = (int) (substr($tin, 6, 2));

        return checkdate($month, $day, $year);
    }

    private function hasValidDate4(string $tin): bool
    {
        $year = (int) (substr($tin, 0, 4));
        $month = (int) (substr($tin, 4, 2));
        $day = (int) (substr($tin, 6, 2));

        return checkdate($month, $day - 60, $year);
    }

    private function isFollowLength1And2(string $tin): bool
    {
        return $this->matchLength($tin, self::LENGTH_1_AND_2);
    }

    private function isFollowLength3And4(string $tin): bool
    {
        return $this->matchLength($tin, self::LENGTH_3_AND_4);
    }

    private function isFollowPattern1(string $tin): bool
    {
        return $this->matchPattern($tin, self::PATTERN_1);
    }

    private function isFollowPattern1AndIsValidDate1(string $tin): bool
    {
        return $this->isFollowPattern1($tin) && $this->hasValidDate1($tin);
    }

    private function isFollowPattern2(string $tin): bool
    {
        return $this->matchPattern($tin, self::PATTERN_2);
    }

    private function isFollowPattern2AndIsValidDate2(string $tin): bool
    {
        return $this->isFollowPattern2($tin) && $this->hasValidDate2($tin);
    }

    private function isFollowPattern3(string $tin): bool
    {
        return $this->matchPattern($tin, self::PATTERN_3);
    }

    private function isFollowPattern3AndIsValidDate3(string $tin): bool
    {
        return $this->isFollowPattern3($tin) && $this->hasValidDate3($tin);
    }

    private function isFollowPattern4(string $tin): bool
    {
        return $this->matchPattern($tin, self::PATTERN_4);
    }

    private function isFollowPattern4AndIsValidDate4(string $tin): bool
    {
        return $this->isFollowPattern4($tin) && $this->hasValidDate4($tin);
    }

    private function isFollowSwedenRule1And2(string $tin): bool
    {
        $c1 = $this->digitAt($tin, 0);
        $c2 = $this->digitAt($tin, 1);
        $c3 = $this->digitAt($tin, 2);
        $c4 = $this->digitAt($tin, 3);
        $c5 = $this->digitAt($tin, 4);
        $c6 = $this->digitAt($tin, 5);
        $c7 = $this->digitAt($tin, 6);
        $c8 = $this->digitAt($tin, 7);
        $c9 = $this->digitAt($tin, 8);
        $c10 = $this->digitAt($tin, 9);

        $sum = $c2 + $c4 + $c6 + $c8
            + $this->digitsSum($c1 * 2)
            + $this->digitsSum($c3 * 2)
            + $this->digitsSum($c5 * 2)
            + $this->digitsSum($c7 * 2)
            + $this->digitsSum($c9 * 2);

        $check = 10 - $this->getLastDigit($sum);

        if (10 !== $check) {
            return $c10 === $check;
        }

        return 0 === $c10;
    }

    private function isFollowSwedenRule3And4(string $tin): bool
    {
        $c3 = $this->digitAt($tin, 2);
        $c4 = $this->digitAt($tin, 3);
        $c5 = $this->digitAt($tin, 4);
        $c6 = $this->digitAt($tin, 5);
        $c7 = $this->digitAt($tin, 6);
        $c8 = $this->digitAt($tin, 7);
        $c9 = $this->digitAt($tin, 8);
        $c10 = $this->digitAt($tin, 9);
        $c11 = $this->digitAt($tin, 10);
        $c12 = $this->digitAt($tin, 11);

        $sum = $c4 + $c6 + $c8 + $c10
            + $this->digitsSum($c3 * 2)
            + $this->digitsSum($c5 * 2)
            + $this->digitsSum($c7 * 2)
            + $this->digitsSum($c9 * 2)
            + $this->digitsSum($c11 * 2);
        $check = 10 - $this->getLastDigit($sum);

        if (10 !== $check) {
            return $c12 === $check;
        }

        return 0 === $c12;
    }
}
