<?php

declare(strict_types=1);

namespace LeKoala\Tin\CountryHandler;

/**
 * Austria.
 */
final class Austria extends CountryHandler
{
    /**
     * @var string
     */
    public const COUNTRYCODE = 'AT';

    /**
     * @var int
     */
    public const LENGTH = 9;

    /**
     * @var string
     */
    public const PATTERN = '\\d{9}';

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
        $c9 = $this->digitAt($tin, 8);

        $sum = (int) array_sum([
            $c1,
            $c3,
            $c5,
            $c7,
            $this->digitsSum($c2 * 2),
            $this->digitsSum($c4 * 2),
            $this->digitsSum($c6 * 2),
            $this->digitsSum($c8 * 2),
        ]);

        $check = $this->getLastDigit(100 - $sum);

        return $c9 === $check;
    }
}
