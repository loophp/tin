<?php

declare(strict_types=1);

namespace LeKoala\Tin\CountryHandler;

use LeKoala\Tin\Exception\TINException;

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
     *
     * @param string $tin
     */
    final public function __construct(string $tin = '')
    {
        $this->tin = $tin;
    }

    /**
     * @return string
     */
    public function getTIN(): string
    {
        if (null !== $string = preg_replace('#[^[:alnum:]\-+]#u', '', $this->tin)) {
            return strtoupper($string);
        }

        return '';
    }

    /**
     * {@inheritdoc}
     */
    final public static function supports(string $country): bool
    {
        return strtoupper($country) === strtoupper(static::COUNTRYCODE);
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
     *
     * @return CountryHandlerInterface
     */
    final public function withTIN(string $tin): CountryHandlerInterface
    {
        $clone = clone $this;
        $clone->tin = $tin;

        return $clone;
    }

    /**
     * Get digit at a given position.
     *
     * @param string $str
     * @param int $index
     *
     * @return int
     */
    protected function digitAt(string $str, int $index): int
    {
        return (int) $str[$index] ?? 0;
    }

    /**
     * @param int $int
     *
     * @return int
     */
    protected function digitsSum(int $int): int
    {
        return array_reduce(
            (array) str_split((string) $int),
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
     *
     * @param string $character
     *
     * @return int
     */
    protected function getAlphabeticalPosition(string $character): int
    {
        return false !== ($return = array_combine(range('a', 'z'), range(1, 26))) ?
            $return[strtolower($character)] :
            0;
    }

    /**
     * @param int $number
     *
     * @return int
     */
    protected function getLastDigit(int $number): int
    {
        $split = (array) str_split((string) $number);

        return (int) end($split);
    }

    protected function hasValidDate(string $tin): bool
    {
        return true;
    }

    /**
     * Match length.
     *
     * @param string $tin
     *
     * @return bool
     */
    protected function hasValidLength(string $tin): bool
    {
        return $this->matchLength($this->getTIN(), static::LENGTH);
    }

    /**
     * @param string $tin
     *
     * @return bool
     */
    protected function hasValidPattern(string $tin): bool
    {
        return $this->matchPattern($this->getTIN(), static::PATTERN);
    }

    protected function hasValidRule(string $tin): bool
    {
        return true;
    }

    /**
     * @param string $tin
     * @param int $length
     *
     * @return bool
     */
    protected function matchLength(string $tin, int $length): bool
    {
        return strlen($tin) === $length;
    }

    /**
     * @param string $subject
     * @param string $pattern
     *
     * @return bool
     */
    protected function matchPattern(string $subject, string $pattern): bool
    {
        return 1 === preg_match(sprintf('/%s/', $pattern), $subject);
    }
}
