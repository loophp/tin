<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace loophp\Tin;

use loophp\Tin\CountryHandler\Austria;
use loophp\Tin\CountryHandler\Belgium;
use loophp\Tin\CountryHandler\Bulgaria;
use loophp\Tin\CountryHandler\CountryHandlerInterface;
use loophp\Tin\CountryHandler\Croatia;
use loophp\Tin\CountryHandler\Cyprus;
use loophp\Tin\CountryHandler\CzechRepublic;
use loophp\Tin\CountryHandler\Denmark;
use loophp\Tin\CountryHandler\Estonia;
use loophp\Tin\CountryHandler\Finland;
use loophp\Tin\CountryHandler\France;
use loophp\Tin\CountryHandler\Germany;
use loophp\Tin\CountryHandler\Greece;
use loophp\Tin\CountryHandler\Hungary;
use loophp\Tin\CountryHandler\Ireland;
use loophp\Tin\CountryHandler\Italy;
use loophp\Tin\CountryHandler\Latvia;
use loophp\Tin\CountryHandler\Lithuania;
use loophp\Tin\CountryHandler\Luxembourg;
use loophp\Tin\CountryHandler\Malta;
use loophp\Tin\CountryHandler\Netherlands;
use loophp\Tin\CountryHandler\Poland;
use loophp\Tin\CountryHandler\Portugal;
use loophp\Tin\CountryHandler\Romania;
use loophp\Tin\CountryHandler\Slovakia;
use loophp\Tin\CountryHandler\Slovenia;
use loophp\Tin\CountryHandler\Spain;
use loophp\Tin\CountryHandler\Sweden;
use loophp\Tin\CountryHandler\UnitedKingdom;
use loophp\Tin\Exception\TINException;

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
        'CZ' => CzechRepublic::class,
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

    private function __construct(string $slug)
    {
        $this->slug = $slug;
    }

    /**
     * @throws TINException
     */
    public function check(): bool
    {
        $parsedTin = $this->parse($this->slug);

        return $this->getAlgorithm($parsedTin['country'], $parsedTin['tin'])->validate();
    }

    public static function from(string $countryCode, string $tin): TIN
    {
        return self::fromSlug($countryCode . $tin);
    }

    public static function fromSlug(string $slug): TIN
    {
        return new self($slug);
    }

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
     * @throws TINException
     */
    private function getAlgorithm(string $country, ?string $tin = null): CountryHandlerInterface
    {
        foreach ($this->algorithms as $algorithm) {
            if (true === $algorithm::supports($country)) {
                $handler = new $algorithm($tin);

                if ($handler instanceof CountryHandlerInterface) {
                    return $handler;
                }
            }
        }

        throw TINException::invalidCountry($country);
    }

    /**
     * @throws TINException
     *
     * @return array<string, string>
     */
    private function parse(string $slug): array
    {
        return array_combine(
            ['country', 'tin'],
            sscanf($slug, '%2s%s')
        );
    }
}
