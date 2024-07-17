<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace loophp\Tin\CountryHandler;

/**
 * Netherlands.
 */
final class Netherlands extends CountryHandler
{
    /**
     * @var string
     */
    public const COUNTRYCODE = 'NL';

    /**
     * @var int
     */
    public const LENGTH = 9;

    /**
     * @var string
     */
    public const PATTERN = '\d{9}';

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
        $sum = $c1 * 9 + $c2 * 8 + $c3 * 7 + $c4 * 6 + $c5 * 5 + $c6 * 4 + $c7 * 3 + $c8 * 2;
        $remainderBy11 = $sum % 11;

        if (10 === $remainderBy11) {
            return false;
        }

        return $c9 === $remainderBy11;
    }
}
