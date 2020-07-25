<?php

declare(strict_types=1);

namespace loophp\Tin\CountryHandler;

/**
 * Estonia.
 */
final class Estonia extends CountryHandler
{
    /**
     * @var string
     */
    public const COUNTRYCODE = 'EE';

    /**
     * @var int
     */
    public const LENGTH = 11;

    /**
     * @var string
     */
    public const PATTERN = '[1-6]\\d{2}[0-1]\\d[0-3]\\d{5}';

    protected function hasValidDate(string $tin): bool
    {
        $year = (int) (mb_substr($tin, 1, 2));
        $month = (int) (mb_substr($tin, 3, 2));
        $day = (int) (mb_substr($tin, 5, 2));

        $d1 = checkdate($month, $day, 1900 + $year);
        $d2 = checkdate($month, $day, 2000 + $year);

        return $d1 || $d2;
    }

    protected function hasValidRule(string $tin): bool
    {
        $range = (int) (mb_substr($tin, 7, 3));

        if (false === (0 < $range && 711 > $range)) {
            return false;
        }

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
        $c11 = $this->digitAt($tin, 10);
        $sum = $c1 + $c2 * 2 + $c3 * 3 + $c4 * 4 + $c5 * 5 + $c6 * 6 + $c7 * 7 + $c8 * 8 + $c9 * 9 + $c10;
        $remainderBy11 = $sum % 11;

        return (10 > $remainderBy11 && $remainderBy11 === $c11) ||
            (10 === $remainderBy11 && $this->isFollowEstoniaRulePart2($tin));
    }

    private function isFollowEstoniaRulePart2(string $tin): bool
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
        $c11 = $this->digitAt($tin, 10);
        $sum = $c1 * 3 + $c2 * 4 + $c3 * 5 + $c4 * 6 + $c5 * 7 + $c6 * 8 + $c7 * 9 + $c8 + $c9 * 2 + $c10 * 3;
        $remainderBy11 = $sum % 11;

        return (10 > $remainderBy11 && $remainderBy11 === $c11) || (10 === $remainderBy11 && 0 === $c11);
    }
}
