<?php

declare(strict_types=1);

namespace loophp\Tin\CountryHandler;

use function array_key_exists;
use function in_array;

/**
 * Czech Republic.
 *
 * Source: https://github.com/czechphp/national-identification-number-validator
 */
final class CzeckRepublic extends CountryHandler
{
    /**
     * @var string
     */
    public const COUNTRYCODE = 'CY';

    /**
     * @var int
     */
    public const LENGTH_1 = 9;

    /**
     * @var int
     */
    public const LENGTH_2 = 10;

    // phpcs:disable

    /**
     * @var string
     */
    public const PATTERN = '^(?<year>\d{2})(?<month>\d{2})(?<day>\d{2})(?<slash>\/)?(?<sequence>\d{3})(?<modulo>\d{1})?$';

    // phpcs:enable

    /**
     * @var int
     */
    private const MODULO = 11;

    /**
     * @var int
     */
    private const MONTH_AFTER_2004 = 20;

    /**
     * @var int
     */
    private const MONTH_FEMALE = 50;

    /**
     * @param string $tin
     *
     * @return bool
     */
    protected function hasValidDate(string $tin): bool
    {
        // If we reach this point, it means that it's already validated.
        preg_match(sprintf('/%s/', self::PATTERN), $tin, $matches);

        $hasModulo = array_key_exists('modulo', $matches) && '' !== $matches['modulo'];

        // range of months from 1 to 12
        $allowedMonths = array_merge(
            range(
                1,
                12
            ), // male
            range(
                1 + self::MONTH_FEMALE,
                12 + self::MONTH_FEMALE
            ) // female
        );

        // from year 2004 there can be people with +20 in their month number
        // without modulo check it would work for people born between 1904 and 19{last_two_digits_of_current_year} too
        if (true === $hasModulo && 4 <= $matches['year'] && date('y') >= $matches['year']) {
            $allowedMonths = array_merge(
                $allowedMonths,
                range(
                    1 + self::MONTH_AFTER_2004,
                    12 + self::MONTH_AFTER_2004
                ), // male
                range(
                    1 + self::MONTH_FEMALE + self::MONTH_AFTER_2004,
                    12 + self::MONTH_FEMALE + self::MONTH_AFTER_2004
                ) // female
            );
        }

        if (!in_array((int) $matches['month'], $allowedMonths, true)) {
            return false;
        }

        // day is between 1 and 31
        if (1 > $matches['day'] || 31 < $matches['day']) {
            return false;
        }

        return true;
    }

    protected function hasValidLength(string $tin): bool
    {
        return $this->isFollowLength1($tin) || $this->isFollowLength2($tin);
    }

    protected function hasValidRule(string $tin): bool
    {
        // If we reach this point, it means that it's already validated.
        preg_match(sprintf('/%s/', self::PATTERN), $tin, $matches);

        $hasModulo = array_key_exists('modulo', $matches) && '' !== $matches['modulo'];

        // after year 1953 everyone should have modulo
        // this validation does not work for people born since year 2000
        if (53 < $matches['year'] && false === $hasModulo) {
            return false;
        }

        // if there is no modulo then sequence can be between 001 and 999
        if (false === $hasModulo && 1 > $matches['sequence']) {
            return false;
        }

        // number's modulo should be 0
        if (true === $hasModulo) {
            $number = (int) $matches['year'] . $matches['month'] . $matches['day'] . $matches['sequence'];
            $modulo = $number % self::MODULO;

            // from year 1954 to 1985 and sometimes even after that, modulo can be 10 which results in 0 as modulo
            if (10 === $modulo) {
                $modulo = 0;
            }

            if (((int) $matches['modulo']) !== $modulo) {
                return false;
            }
        }

        return true;
    }

    private function isFollowLength1(string $tin): bool
    {
        return $this->matchLength($tin, self::LENGTH_1);
    }

    private function isFollowLength2(string $tin): bool
    {
        return $this->matchLength($tin, self::LENGTH_2);
    }
}
