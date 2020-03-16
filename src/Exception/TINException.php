<?php

declare(strict_types=1);

namespace loophp\Tin\Exception;

use Exception;

/**
 * Base class for all exceptions.
 */
final class TINException extends Exception
{
    public static function invalidCountry(string $countryCode): TINException
    {
        return new self(sprintf('No handler available for this country code: %s.', $countryCode));
    }

    public static function invalidDate(): TINException
    {
        return new self('Invalid date.');
    }

    public static function invalidLength(): TINException
    {
        return new self('Invalid length.');
    }

    public static function invalidPattern(): TINException
    {
        return new self('Invalid pattern.');
    }

    public static function invalidSyntax(): TINException
    {
        return new self('Invalid syntax.');
    }
}
