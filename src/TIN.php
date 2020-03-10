<?php

declare(strict_types=1);

namespace LeKoala\Tin;

use LeKoala\Tin\CountryHandler\Austria;
use LeKoala\Tin\CountryHandler\Belgium;
use LeKoala\Tin\CountryHandler\Bulgaria;
use LeKoala\Tin\CountryHandler\CountryHandlerInterface;
use LeKoala\Tin\CountryHandler\Croatia;
use LeKoala\Tin\CountryHandler\Cyprus;
use LeKoala\Tin\CountryHandler\CzeckRepublic;
use LeKoala\Tin\CountryHandler\Denmark;
use LeKoala\Tin\CountryHandler\Estonia;
use LeKoala\Tin\CountryHandler\Finland;
use LeKoala\Tin\CountryHandler\France;
use LeKoala\Tin\CountryHandler\Germany;
use LeKoala\Tin\CountryHandler\Greece;
use LeKoala\Tin\CountryHandler\Hungary;
use LeKoala\Tin\CountryHandler\Ireland;
use LeKoala\Tin\CountryHandler\Italy;
use LeKoala\Tin\CountryHandler\Latvia;
use LeKoala\Tin\CountryHandler\Lithuania;
use LeKoala\Tin\CountryHandler\Luxembourg;
use LeKoala\Tin\CountryHandler\Malta;
use LeKoala\Tin\CountryHandler\Netherlands;
use LeKoala\Tin\CountryHandler\Poland;
use LeKoala\Tin\CountryHandler\Portugal;
use LeKoala\Tin\CountryHandler\Romania;
use LeKoala\Tin\CountryHandler\Slovakia;
use LeKoala\Tin\CountryHandler\Slovenia;
use LeKoala\Tin\CountryHandler\Spain;
use LeKoala\Tin\CountryHandler\Sweden;
use LeKoala\Tin\CountryHandler\UnitedKingdom;
use LeKoala\Tin\Exception\TINException;

/**
 * The main class to validate TIN numbers.
 */
final class TIN
{
    /**
     * @var array<string, class-string>
     */
    private $algorithms = [
        'AT' => Austria::class,
        'BE' => Belgium::class,
        'BG' => Bulgaria::class,
        'CY' => Cyprus::class,
        'CZ' => CzeckRepublic::class,
        'DE' => Germany::class,
        'DK' => Denmark::class,
        'EE' => Estonia::class,
        'ES' => Spain::class,
        'FI' => Finland::class,
        'FR' => France::class,
        'GR' => Greece::class,
        'HR' => Croatia::class,
        'HU' => Hungary::class,
        'IE' => Ireland::class,
        'IT' => Italy::class,
        'LT' => Lithuania::class,
        'LU' => Luxembourg::class,
        'LV' => Latvia::class,
        'MT' => Malta::class,
        'NL' => Netherlands::class,
        'PL' => Poland::class,
        'PT' => Portugal::class,
        'RO' => Romania::class,
        'SE' => Sweden::class,
        'SI' => Slovenia::class,
        'SK' => Slovakia::class,
        'UK' => UnitedKingdom::class,
    ];

    /**
     * @var string
     */
    private $slug;

    /**
     * @throws TINException
     *
     * @return bool
     */
    public function check(): bool
    {
        $parsedTin = $this->parse($this->slug);

        return $this->getAlgorithm($parsedTin['country'], $parsedTin['tin'])->validate();
    }

    /**
     * @param string $countryCode
     * @param string $tin
     *
     * @return TIN
     */
    public static function from(string $countryCode, string $tin): TIN
    {
        return self::fromSlug($countryCode . $tin);
    }

    /**
     * @param string $slug
     *
     * @return TIN
     */
    public static function fromSlug(string $slug): TIN
    {
        $instance = new self();

        $instance->slug = $slug;

        return $instance;
    }

    /**
     * @return bool
     */
    public function isValid(): bool
    {
        try {
            $this->check();
        } catch (TINException $e) {
            return false;
        }

        return true;
    }

    /**
     * @param string $country
     * @param string|null $tin
     *
     * @throws TINException
     *
     * @return CountryHandlerInterface
     */
    private function getAlgorithm(string $country, ?string $tin = null): CountryHandlerInterface
    {
        foreach ($this->algorithms as $algorithm) {
            if (true === $algorithm::supports($country)) {
                return new $algorithm($tin);
            }
        }

        throw TINException::invalidCountry($country);
    }

    /**
     * @param string $slug
     *
     * @throws TINException
     *
     * @return array<array-key, string>
     */
    private function parse(string $slug): array
    {
        $matches = [];
        $pattern = '(?<country>[[:alpha:]]{2})(?<tin>([^[:alpha:]])([[:alnum:]\-+]+))';

        // [alpha][alpha][not-alpha](anything)
        if (0 === preg_match(sprintf('/^%s$/', $pattern), $slug, $matches)) {
            throw TINException::invalidPattern();
        }

        return array_intersect_key($matches, array_flip(['country', 'tin']));
    }
}
