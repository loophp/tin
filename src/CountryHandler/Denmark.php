<?php

declare(strict_types=1);

namespace loophp\Tin\CountryHandler;

use function in_array;

/**
 * Denmark.
 */
final class Denmark extends CountryHandler
{
    /**
     * @var string
     */
    public const COUNTRYCODE = 'DK';

    /**
     * @var int
     */
    public const LENGTH = 10;

    /**
     * @var string
     */
    public const PATTERN = '[0-3]\\d[0-1]\\d{3}\\d{4}';

    protected function hasValidDate(string $tin): bool
    {
        $day = (int) (substr($tin, 0, 2));
        $month = (int) (substr($tin, 2, 2));
        $year = (int) (substr($tin, 4, 2));

        $d1 = checkdate($month, $day, 1900 + $year);
        $d2 = checkdate($month, $day, 2000 + $year);

        return $d1 || $d2;
    }

    /**
     * @see https://cpr.dk/cpr-systemet/personnumre-uden-kontrolciffer-modulus-11-kontrol/
     *
     * The CPR office has since 2007 given out social security numbers without the so called modulus 11 control.
     * The social security numbers without modulus 11 are completely valid
     * and are given out, as some birth years no longer have the capacity to provide them with modulus 11 control.
     *
     * We should not check modulus 11 control for the following birthdays:
     *
     * 1st of January 1960
     * 1st of January 1964
     * 1st of January 1965
     * 1st of January 1966
     * 1st of January 1969
     * 1st of January 1970
     * 1st of January 1974
     * 1st of January 1980
     * 1st of January 1982
     * 1st of January 1984
     * 1st of January 1985
     * 1st of January 1986
     * 1st of January 1987
     * 1st of January 1988
     * 1st of January 1989
     * 1st of January 1990
     * 1st of January 1991
     * 1st of January 1992
     *
     * @param string $tin
     *
     * @return bool
     */
    protected function hasValidRule(string $tin): bool
    {
        $serialNumber = (int) (substr($tin, 6, 4));
        $dayOfBirth = (int) (substr($tin, 0, 2));
        $monthOfBirth = (int) (substr($tin, 2, 2));
        $yearOfBirth = (int) (substr($tin, 4, 2));

        if (37 <= $yearOfBirth && 57 >= $yearOfBirth && 5000 <= $serialNumber && 8999 >= $serialNumber) {
            return false;
        }

        $excludedYears = [60, 64, 65, 66, 69, 70, 74, 80, 82, 84, 85, 86, 87, 88, 89, 90, 91, 92];

        if (1 === $dayOfBirth && 1 === $monthOfBirth && in_array($yearOfBirth, $excludedYears, true)) {
            return true;
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
        $sum = $c1 * 4 + $c2 * 3 + $c3 * 2 + $c4 * 7 + $c5 * 6 + $c6 * 5 + $c7 * 4 + $c8 * 3 + $c9 * 2;
        $remainderBy11 = $sum % 11;

        if (1 === $remainderBy11) {
            return false;
        }

        if (0 === $remainderBy11) {
            return 0 === $c10;
        }

        return 11 - $remainderBy11 === $c10;
    }
}
