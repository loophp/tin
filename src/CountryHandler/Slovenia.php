<?php

declare(strict_types=1);

namespace loophp\Tin\CountryHandler;

/**
 * Slovenia.
 */
final class Slovenia extends CountryHandler
{
    /**
     * @var string
     */
    public const COUNTRYCODE = 'SI';

    /**
     * @var int
     */
    public const LENGTH = 8;

    /**
     * @var string
     */
    public const PATTERN = '[1-9]\\d{7}';

    protected function hasValidRule(string $tin): bool
    {
        return $this->isFollowRangeRule($tin) && $this->isFollowSloveniaRule($tin);
    }

    private function isFollowRangeRule(string $tin): bool
    {
        $intTIN = (int) (mb_substr($tin, 0, 7));

        return 999999 < $intTIN && 10000000 > $intTIN;
    }

    private function isFollowSloveniaRule(string $tin): bool
    {
        $c1 = $this->digitAt($tin, 0);
        $c2 = $this->digitAt($tin, 1);
        $c3 = $this->digitAt($tin, 2);
        $c4 = $this->digitAt($tin, 3);
        $c5 = $this->digitAt($tin, 4);
        $c6 = $this->digitAt($tin, 5);
        $c7 = $this->digitAt($tin, 6);
        $c8 = $this->digitAt($tin, 7);
        $sum = $c1 * 8 + $c2 * 7 + $c3 * 6 + $c4 * 5 + $c5 * 4 + $c6 * 3 + $c7 * 2;
        $remainderBy11 = $sum % 11;

        return 11 - $remainderBy11 === $c8 || (10 === 11 - $remainderBy11 && 0 === $c8);
    }
}
