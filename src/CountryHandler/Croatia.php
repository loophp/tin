<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace loophp\Tin\CountryHandler;

/**
 * Croatia.
 */
final class Croatia extends CountryHandler
{
    /**
     * @var string
     */
    public const COUNTRYCODE = 'HR';

    /**
     * @var int
     */
    public const LENGTH = 11;

    /**
     * @var string
     */
    public const PATTERN = '\d{11}';

    protected function hasValidRule(string $tin): bool
    {
        $rest = 0;
        $sum = $this->digitAt($tin, 0) + 10;

        for ($i = 1; 11 > $i; ++$i) {
            $rest = $sum % 10;
            $rest = ((0 === $rest) ? 10 : $rest) * 2 % 11;
            $sum = $rest + $this->digitAt($tin, $i);
        }
        $diff = 11 - $rest;
        $lastDigit = $this->digitAt($tin, 10);

        return (1 === $rest && 0 === $lastDigit) || $lastDigit === $diff;
    }
}
