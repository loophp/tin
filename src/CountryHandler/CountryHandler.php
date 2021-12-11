<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace loophp\Tin\CountryHandler;

use loophp\Tin\Exception\TINException;

use function strlen;

/**
 * Base handler class.
 */
abstract class CountryHandler implements CountryHandlerInterface
{
    /**
     * @var string
     */
    private $tin;

    /**
     * CountryHandler constructor.
     */
    final public function __construct(string $tin = '')
    {
        $this->tin = $tin;
    }

    public function getTIN(): string
    {
        if (null !== $string = preg_replace('#[^[:alnum:]\-+]#u', '', $this->tin)) {
            return strtoupper($string);
        }

        return '';
    }

    final public static function supports(string $country): bool
    {
        return strtoupper($country) === strtoupper(static::COUNTRYCODE);
    }

    final public function validate(): bool
    {
        $tin = $this->getTIN();

        if (!$this->hasValidLength($tin)) {
            throw TINException::invalidLength($this->tin);
        }

        if (!$this->hasValidPattern($tin)) {
            throw TINException::invalidPattern($this->tin);
        }

        if (!$this->hasValidDate($tin)) {
            throw TINException::invalidDate($this->tin);
        }

        if (!$this->hasValidRule($tin)) {
            throw TINException::invalidSyntax($this->tin);
        }

        return true;
    }

    /**
     * @param string $tin
     *   The TIN.
     */
    final public function withTIN(string $tin): CountryHandlerInterface
    {
        $clone = clone $this;
        $clone->tin = $tin;

        return $clone;
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
        return $this->matchLength($this->getTIN(), static::LENGTH);
    }

    protected function hasValidPattern(string $tin): bool
    {
        return $this->matchPattern($this->getTIN(), static::PATTERN);
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
        return 1 === preg_match(sprintf('/%s/', $pattern), $subject);
    }
}
