<?php

declare(strict_types=1);

namespace loophp\Tin\CountryHandler;

/**
 * Latvia.
 */
final class Latvia extends CountryHandler
{
    /**
     * @var string
     */
    public const COUNTRYCODE = 'LV';

    /**
     * @var int
     */
    public const LENGTH = 11;

    protected function hasValidDate(string $tin): bool
    {
        $c1c2 = mb_substr($tin, 0, 2);

        if ('32' === $c1c2) {
            return true;
        }
        $day = (int) $c1c2;
        $month = (int) (mb_substr($tin, 2, 2));
        $year = (int) (mb_substr($tin, 4, 2));

        $y1 = checkdate($month, $day, 1900 + $year);
        $y2 = checkdate($month, $day, 2000 + $year);

        return $y1 && $y2;
    }
}
