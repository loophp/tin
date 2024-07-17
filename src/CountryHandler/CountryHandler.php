<?php

declare(strict_types=1);

namespace loophp\Tin\CountryHandler;

use loophp\Tin\Exception\TINException;

use function strlen;

abstract class CountryHandler implements CountryHandlerInterface
{
    final public static function supports(string $country): bool
    {
        return strtoupper($country) === strtoupper(static::COUNTRYCODE);
    }

    final public function validate(string $tin): bool
    {
        $normalizedTin = $this->normalizeTin($tin);

        if (!$this->hasValidLength($normalizedTin)) {
            throw TINException::invalidLength($tin);
        }

        if (!$this->hasValidPattern($normalizedTin)) {
            throw TINException::invalidPattern($tin);
        }

        if (!$this->hasValidDate($normalizedTin)) {
            throw TINException::invalidDate($tin);
        }

        if (!$this->hasValidRule($normalizedTin)) {
            throw TINException::invalidSyntax($tin);
        }

        return true;
    }

    /**
     * Get digit at a given position.
     */
    protected function digitAt(string $str, int $index): int
    {
        return (int) ($str[$index] ?? 0);
    }

    protected function digitsSum(int $int): int
    {
        return array_reduce(
            str_split((string) $int),
            static function (int $carry, string $digit): int {
                return $carry + (int) $digit;
            },
            0
        );
    }

    /**
     * Get the alphabetical position.
     *
     * eg: A = 1
     */
    protected function getAlphabeticalPosition(string $character): int
    {
        return 1 + array_flip(range('a', 'z'))[strtolower($character)];
    }

    protected function getLastDigit(int $number): int
    {
        $split = str_split((string) $number);

        return (int) end($split);
    }

    protected function hasValidDate(string $tin): bool
    {
        return true;
    }

    /**
     * Match length.
     */
    protected function hasValidLength(string $tin): bool
    {
        return $this->matchLength($tin, static::LENGTH);
    }

    protected function hasValidPattern(string $tin): bool
    {
        return $this->matchPattern($tin, static::PATTERN);
    }

    protected function hasValidRule(string $tin): bool
    {
        return true;
    }

    protected function matchLength(string $tin, int $length): bool
    {
        return strlen($tin) === $length;
    }

    protected function matchPattern(string $subject, string $pattern): bool
    {
        return 1 === preg_match(sprintf('/%s/i', $pattern), $subject);
    }

    protected function normalizeTin(string $tin): string
    {
        if (null !== $string = preg_replace('#[^[:alnum:]\-+]#u', '', $tin)) {
            return strtoupper($string);
        }

        return '';
    }
}
