<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace loophp\Tin\CountryHandler;

use const STR_PAD_LEFT;

/**
 * Spain.
 */
final class Spain extends CountryHandler
{
    /**
     * @var string
     */
    public const COUNTRYCODE = 'ES';

    /**
     * @var int
     */
    public const LENGTH = 9;

    /**
     * Spanish Natural Persons: DNI
     * Foreigners with NIE.
     *
     * @var string
     */
    public const PATTERN_1 = '(^[XYZ\d]\d{7})([TRWAGMYFPDXBNJZSQVHLCKE]$)';

    /**
     * Non-resident Spaniards without DNI
     * Resident Spaniards under 14 without DNI
     * Foreigners without NIE
     * Legal entities (companies, organizations, public entities, ...).
     *
     * @var string
     */
    public const PATTERN_2 = '(^[ABCDEFGHIJKLMNPQRSUVW])(\d{7})([JABCDEFGHI\d]$)';

    public function getTIN(): string
    {
        return str_pad(parent::getTIN(), self::LENGTH, '0', STR_PAD_LEFT);
    }

    protected function hasValidPattern(string $tin): bool
    {
        return $this->isFollowPattern1($tin) || $this->isFollowPattern2($tin);
    }

    protected function hasValidRule(string $tin): bool
    {
        return $this->isFollowRule1($tin) || $this->isFollowRule2($tin);
    }

    private function isFollowPattern1(string $tin): bool
    {
        return $this->matchPattern($tin, self::PATTERN_1);
    }

    private function isFollowPattern2(string $tin): bool
    {
        return $this->matchPattern($tin, self::PATTERN_2);
    }

    private function isFollowRule1(string $tin): bool
    {
        if (1 !== preg_match('~' . self::PATTERN_1 . '~', strtoupper($tin), $parts)) {
            return false;
        }

        $control = 'TRWAGMYFPDXBNJZSQVHLCKE';
        $nie = ['X', 'Y', 'Z'];

        $nif = (int) str_replace($nie, array_keys($nie), $parts[1]);

        $cheksum = substr($control, $nif % 23, 1);

        return $parts[2] === $cheksum;
    }

    private function isFollowRule2(string $tin): bool
    {
        if (1 !== preg_match('~' . self::PATTERN_2 . '~', strtoupper($tin), $parts)) {
            return false;
        }

        $checksum = 0;

        foreach (str_split($parts[2]) as $pos => $val) {
            $checksum += array_sum(str_split((string) ((int) $val * (2 - ($pos % 2)))));
        }

        $control = 'JABCDEFGHI';
        $checksum1 = (string) ((10 - ($checksum % 10)) % 10);
        $checksum2 = substr($control, (int) $checksum1, 1);

        return $parts[3] === $checksum1 || $parts[3] === $checksum2;
    }
}
