<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace loophp\Tin\CountryHandler;

use function strlen;

/**
 * Germany.
 */
final class Germany extends CountryHandler
{
    /**
     * @var string
     */
    public const COUNTRYCODE = 'DE';

    /**
     * @var int
     */
    public const LENGTH_1 = 11;

    /**
     * @var int
     */
    public const LENGTH_2 = 11;

    /**
     * @var string
     */
    public const PATTERN_1 = '[1-9]\\d{10}';

    /**
     * @var string
     */
    public const PATTERN_2 = '[1-9]\\d{10}';

    protected function hasValidLength(string $tin): bool
    {
        return $this->isFollowLength1($tin) || $this->isFollowLength2($tin);
    }

    protected function hasValidPattern(string $tin): bool
    {
        return $this->isFollowPattern1($tin) || $this->isFollowPattern2($tin);
    }

    protected function hasValidRule(string $tin): bool
    {
        return ($this->isFollowLength1($tin) && $this->isFollowRuleGermany1($tin))
            || ($this->isFollowLength2($tin) && $this->isFollowRuleGermany2($tin));
    }

    private function calculateCheckDigit(string $tin): int
    {
        $chars = str_split($tin);
        $remainder_mod_eleven = 10;

        for ($length = strlen($tin), $counter = 0; $length - 1 > $counter; ++$counter) {
            $digit = (int) ($chars[$counter]);
            $remainder_mod_ten = ($digit + $remainder_mod_eleven) % 10;

            if (0 === $remainder_mod_ten) {
                $remainder_mod_ten = 10;
            }

            $remainder_mod_eleven = 2 * $remainder_mod_ten % 11;
        }

        $digit = 11 - $remainder_mod_eleven;

        if (10 === $digit) {
            $digit = 0;
        }

        return $digit;
    }

    private function isFollowLength1(string $tin): bool
    {
        return $this->matchLength($tin, self::LENGTH_1);
    }

    private function isFollowLength2(string $tin): bool
    {
        return $this->matchLength($tin, self::LENGTH_2);
    }

    private function isFollowPattern1(string $tin): bool
    {
        if (!$this->matchPattern($tin, self::PATTERN_1)) {
            return false;
        }

        /**
         * @var array<int, int>
         */
        $tab = [];
        /**
         * @var array<int, int>
         */
        $pos = [];

        for ($i = 0; 10 > $i; ++$i) {
            $tab[$i] = $this->digitAt($tin, $i);
            $pos[$i] = 0;
        }

        for ($j = 0; 10 > $j; ++$j) {
            ++$pos[$tab[$j]];
        }
        $isEncounteredTwice2 = false;
        $isEncountered0 = false;

        for ($k = 0; 10 > $k; ++$k) {
            if (2 === $pos[$k]) {
                if ($isEncounteredTwice2) {
                    return false;
                }
                $isEncounteredTwice2 = true;
            }

            if (0 === $pos[$k]) {
                if ($isEncountered0) {
                    return false;
                }
                $isEncountered0 = true;
            }
        }

        return $isEncountered0;
    }

    private function isFollowPattern2(string $tin): bool
    {
        if (!$this->matchPattern($tin, self::PATTERN_2)) {
            return false;
        }

        /**
         * @var array<int, int>
         */
        $tab = [];

        /**
         * @var array<int, int>
         */
        $pos = [];

        for ($i = 0; 10 > $i; ++$i) {
            $tab[$i] = $this->digitAt($tin, $i);
            $pos[$i] = 0;
        }

        for ($i = 0; 8 > $i; ++$i) {
            if ($tab[$i + 1] === $tab[$i] && $tab[$i + 1] === $tab[$i + 2]) {
                return false;
            }
        }

        for ($j = 0; 10 > $j; ++$j) {
            ++$pos[$tab[$j]];
        }
        $isEncounteredTwice2 = false;
        $isEncounteredThrice3 = false;

        for ($k = 0; 10 > $k; ++$k) {
            if (3 < $pos[$k]) {
                return false;
            }

            if (3 === $pos[$k]) {
                if ($isEncounteredThrice3) {
                    return false;
                }
                $isEncounteredThrice3 = true;
            }

            if (2 === $pos[$k]) {
                if ($isEncounteredTwice2) {
                    return false;
                }
                $isEncounteredTwice2 = true;
            }
        }

        return $isEncounteredThrice3 || $isEncounteredTwice2;
    }

    private function isFollowRuleGermany1(string $tin): bool
    {
        $c1 = $this->digitAt($tin, 0);
        $c2 = [];

        for ($i = 0; 9 > $i; ++$i) {
            $c2[$i] = $this->digitAt($tin, $i + 1);
        }
        $result = ($c1 + 10) % 10;

        if (0 === $result) {
            $result = 10;
        }
        $result *= 2;
        $x = $result % 11;

        for ($j = 0; 9 > $j; ++$j) {
            $x = ($x + $c2[$j]) % 10;

            if (0 === $x) {
                $x = 10;
            }
            $x *= 2;
            $x %= 11;
        }
        $c3 = $this->digitAt($tin, 10);
        $total = 11 - $x;

        if (10 === $total) {
            return 0 === $c3;
        }

        return $total === $c3;
    }

    private function isFollowRuleGermany2(string $tin): bool
    {
        return $this->digitAt($tin, 10) === $this->calculateCheckDigit($tin);
    }
}
