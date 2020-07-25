<?php

declare(strict_types=1);

namespace loophp\Tin\CountryHandler;

use loophp\Tin\Exception\TINException;

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
            return mb_strtoupper($string);
        }

        return '';
    }

    /**
     * {@inheritdoc}
     */
    final public static function supports(string $country): bool
    {
        return mb_strtoupper($country) === mb_strtoupper(static::COUNTRYCODE);
    }

    final public function validate(): bool
    {
        $tin = $this->getTIN();

        if (!$this->hasValidLength($tin)) {
            throw TINException::invalidLength();
        }

        if (!$this->hasValidPattern($tin)) {
            throw TINException::invalidPattern();
        }

        if (!$this->hasValidDate($tin)) {
            throw TINException::invalidDate();
        }

        if (!$this->hasValidRule($tin)) {
            throw TINException::invalidSyntax();
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
            (array) mb_str_split((string) $int),
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
        return false !== ($return = array_combine(range('a', 'z'), range(1, 26))) ?
            $return[mb_strtolower($character)] :
            0;
    }

    protected function getLastDigit(int $number): int
    {
        $split = (array) mb_str_split((string) $number);

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
        return mb_strlen($tin) === $length;
    }

    protected function matchPattern(string $subject, string $pattern): bool
    {
        return 1 === preg_match(sprintf('/%s/', $pattern), $subject);
    }
}
