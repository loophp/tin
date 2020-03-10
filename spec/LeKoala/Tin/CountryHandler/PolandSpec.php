<?php

declare(strict_types=1);

namespace spec\LeKoala\Tin\CountryHandler;

use tests\LeKoala\Tin\AbstractAlgorithmSpec;

class PolandSpec extends AbstractAlgorithmSpec
{
    public const INVALID_NUMBER_CHECK = '2234567894';

    public const INVALID_NUMBER_LENGTH = '2234';

    public const INVALID_NUMBER_PATTERN = 'wwwwwwwwwww';

    public const VALID_NUMBER = ['2234567895', '02070803628'];
}
