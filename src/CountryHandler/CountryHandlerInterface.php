<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace loophp\Tin\CountryHandler;

use loophp\Tin\Exception\TINException;

/**
 * Base interface for a validation algorithm, as used in TINValid class.
 */
interface CountryHandlerInterface
{
    /**
     * @var string
     */
    public const COUNTRYCODE = 'UNKNOWN';

    /**
     * @var int
     */
    public const LENGTH = 0;

    /**
     * @var string
     */
    public const PATTERN = '';

    /**
     * Check if the algorithm supports the TIN.
     *
     * @param string $country
     *   The TIN.
     *
     * @return bool
     *   True if it supports it, false otherwise.
     */
    public static function supports(string $country): bool;

    /**
     * Validate a tin number.
     *
     * @throws TINException
     */
    public function validate(): bool;

    public function withTIN(string $tin): CountryHandlerInterface;
}
