<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace loophp\Tin\CountryHandler;

use function in_array;

use const STR_PAD_LEFT;

/**
 * Malta.
 */
final class Malta extends CountryHandler
{
    /**
     * @var string
     */
    public const COUNTRYCODE = 'MT';

    /**
     * @var int
     */
    public const LENGTH = 8;

    public function getTIN(): string
    {
        return str_pad(parent::getTIN(), self::LENGTH, '0', STR_PAD_LEFT);
    }

    protected function hasValidRule(string $tin): bool
    {
        $valid = ['M', 'G', 'A', 'P', 'L', 'H', 'B', 'Z'];

        return in_array($tin[7], $valid, true);
    }
}
