<?php

declare(strict_types=1);

namespace loophp\Tin\CountryHandler;

use function ord;

/**
 * Cyprus.
 */
final class Cyprus extends CountryHandler
{
    /**
     * @var string
     */
    public const COUNTRYCODE = 'CY';

    /**
     * @var int
     */
    public const LENGTH = 9;

    /**
     * @var string
     */
    public const PATTERN = '[0,9]\d{7}[A-Z]';

    protected function hasValidRule(string $tin): bool
    {
        $c1 = $this->digitAt($tin, 0);
        $c2 = $this->digitAt($tin, 1);
        $c3 = $this->digitAt($tin, 2);
        $c4 = $this->digitAt($tin, 3);
        $c5 = $this->digitAt($tin, 4);
        $c6 = $this->digitAt($tin, 5);
        $c7 = $this->digitAt($tin, 6);
        $c8 = $this->digitAt($tin, 7);
        $c9 = ord($tin[8]);

        $evenPositionNumbersSum = $c2 + $c4 + $c6 + $c8;

        $recodedSum = array_sum([
            $this->recodeValue($c1),
            $this->recodeValue($c3),
            $this->recodeValue($c5),
            $this->recodeValue($c7),
        ]);

        $remainderBy26 = ($evenPositionNumbersSum + $recodedSum) % 26;

        return $remainderBy26 + 65 === $c9;
    }

    private function recodeValue(int $x): int
    {
        switch ($x) {
            case 1:
                return 0;

            case 2:
                return 5;

            case 3:
                return 7;

            case 4:
                return 9;

            case 5:
                return 13;

            case 6:
                return 15;

            case 7:
                return 17;

            case 8:
                return 19;

            case 9:
                return 21;
        }

        return 1;
    }
}
