<?php

declare(strict_types=1);

namespace LeKoala\Tin\CountryHandler;

use function count;

/**
 * Luxembourg.
 */
final class Luxembourg extends CountryHandler
{
    /**
     * @var string
     */
    public const COUNTRYCODE = 'LU';

    /**
     * @var int
     */
    public const LENGTH = 13;

    /**
     * @var string
     */
    public const PATTERN = '(1[89]|20)\\d{2}(0[1-9]|1[012])(0[1-9]|[1-2][0-9]|3[0-1])\\d{5}';

    /**
     * @var array<int, array<int, int>>
     */
    private static $D = [
        [0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
        [1, 2, 3, 4, 0, 6, 7, 8, 9, 5],
        [2, 3, 4, 0, 1, 7, 8, 9, 5, 6],
        [3, 4, 0, 1, 2, 8, 9, 5, 6, 7],
        [4, 0, 1, 2, 3, 9, 5, 6, 7, 8],
        [5, 9, 8, 7, 6, 0, 4, 3, 2, 1],
        [6, 5, 9, 8, 7, 1, 0, 4, 3, 2],
        [7, 6, 5, 9, 8, 2, 1, 0, 4, 3],
        [8, 7, 6, 5, 9, 3, 2, 1, 0, 4],
        [9, 8, 7, 6, 5, 4, 3, 2, 1, 0],
    ];

    /**
     * @var array<int, array<int, int>>
     */
    private static $P = [
        [0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
        [1, 5, 7, 6, 2, 8, 3, 0, 9, 4],
        [5, 8, 0, 3, 7, 9, 6, 1, 4, 2],
        [8, 9, 1, 6, 0, 4, 3, 5, 2, 7],
        [9, 4, 5, 3, 1, 2, 6, 8, 7, 0],
        [4, 2, 8, 6, 5, 7, 3, 9, 0, 1],
        [2, 7, 9, 3, 8, 0, 6, 4, 1, 5],
        [7, 0, 4, 6, 9, 1, 3, 2, 5, 8],
    ];

    protected function hasValidDate(string $tin): bool
    {
        $year = (int) (substr($tin, 0, 4));
        $month = (int) (substr($tin, 4, 2));
        $day = (int) (substr($tin, 6, 2));

        return checkdate($month, $day, $year);
    }

    protected function hasValidRule(string $tin): bool
    {
        return $this->isFollowLuxembourgRule1($tin) && $this->isFollowLuxembourgRule2($tin);
    }

    private function isFollowLuxembourgRule1(string $tin): bool
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
        $c12 = $this->digitAt($tin, 11);

        $sum = $c2 + $c4 + $c6 + $c8 + $c10 + $c12
            + $this->digitsSum($c1 * 2)
            + $this->digitsSum($c3 * 2)
            + $this->digitsSum($c5 * 2)
            + $this->digitsSum($c7 * 2)
            + $this->digitsSum($c9 * 2)
            + $this->digitsSum($c11 * 2);

        $remainderBy10 = $sum % 10;

        return 0 === $remainderBy10;
    }

    private function isFollowLuxembourgRule2(string $tin): bool
    {
        $listNumbers = [];

        for ($i = 12; 0 <= $i; --$i) {
            if (11 !== $i) {
                $listNumbers[] = $this->digitAt($tin, $i);
            }
        }
        $check = 0;
        $listNumbersCount = count($listNumbers);

        for ($j = 0; $listNumbersCount > $j; ++$j) {
            $item = $listNumbers[$j];
            $p = self::$P[$j % 8][$item];
            $check = self::$D[$check][$p];
        }

        return 0 === $check;
    }
}
