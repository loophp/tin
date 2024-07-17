<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace loophp\Tin\CountryHandler;

/**
 * Lithuania.
 */
final class Lithuania extends CountryHandler
{
    /**
     * @var string
     */
    public const COUNTRYCODE = 'LT';

    /**
     * @var int
     */
    public const LENGTH = 11;

    /**
     * @var string
     */
    public const PATTERN = '[1-6]\d{2}[0-1]\d[0-3]\d{5}';

    protected function hasValidRule(string $tin): bool
    {
        $sum = 0;
        $c11 = (int) (substr($tin, 10));

        for ($i = 0; 10 > $i; ++$i) {
            $sum += $this->multiplyAccordingToWeight((int) (substr($tin, $i, 1)), $i);
        }
        $remainderBy11 = $sum % 11;

        if (10 !== $remainderBy11) {
            return $c11 === $remainderBy11;
        }
        $sum2 = 0;

        for ($j = 0; 10 > $j; ++$j) {
            $sum2 += $this->multiplyAccordingToWeight2((int) (substr($tin, $j, 1)), $j);
        }
        $remainderBy11 = $sum2 % 11;

        if (10 === $remainderBy11) {
            return 0 === $c11;
        }

        return $c11 === $remainderBy11;
    }

    private function multiplyAccordingToWeight(int $val, int $index): int
    {
        switch ($index) {
            case 9:
            case 0:
                return $val * 1;

            case 1:
                return $val * 2;

            case 2:
                return $val * 3;

            case 3:
                return $val * 4;

            case 4:
                return $val * 5;

            case 5:
                return $val * 6;

            case 6:
                return $val * 7;

            case 7:
                return $val * 8;

            case 8:
                return $val * 9;

            default:
                return -1;
        }
    }

    private function multiplyAccordingToWeight2(int $val, int $index): int
    {
        switch ($index) {
            case 9:
            case 0:
                return $val * 3;

            case 1:
                return $val * 4;

            case 2:
                return $val * 5;

            case 3:
                return $val * 6;

            case 4:
                return $val * 7;

            case 5:
                return $val * 8;

            case 6:
                return $val * 9;

            case 7:
                return $val * 1;

            case 8:
                return $val * 2;

            default:
                return -1;
        }
    }
}
