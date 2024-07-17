<?php

declare(strict_types=1);

namespace loophp\Tin\CountryHandler;

/**
 * Romania.
 */
final class Romania extends CountryHandler
{
    /**
     * @var string
     */
    public const COUNTRYCODE = 'RO';

    /**
     * @var int
     */
    public const LENGTH = 13;

    protected function hasValidDate(string $tin): bool
    {
        $year = (int) (substr($tin, 1, 2));
        $month = (int) (substr($tin, 3, 2));
        $day = (int) (substr($tin, 5, 2));

        $y1 = checkdate($month, $day, 1900 + $year);
        $y2 = checkdate($month, $day, 2000 + $year);

        return $y1 && $y2;
    }

    protected function hasValidRule(string $tin): bool
    {
        $c1 = (int) ($tin[0]);

        if (0 === $c1) {
            return false;
        }

        $county = (int) (substr($tin, 7, 2));

        if (47 < $county && 51 !== $county && 52 !== $county) {
            return false;
        }

        return true;
    }
}
