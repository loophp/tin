<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace loophp\Tin\CountryHandler;

/**
 * Slovakia.
 */
final class Slovakia extends CountryHandler
{
    /**
     * @var string
     */
    public const COUNTRYCODE = 'SK';

    /**
     * @var int
     */
    public const LENGTH = 10;

    protected function hasValidLength(string $tin): bool
    {
        $c1c2 = substr($tin, 0, 2);

        if (54 > $c1c2) {
            return $this->matchLength($tin, self::LENGTH - 1);
        }

        return parent::hasValidLength($tin);
    }
}
