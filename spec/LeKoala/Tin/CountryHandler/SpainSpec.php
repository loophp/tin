<?php

declare(strict_types=1);

namespace spec\LeKoala\Tin\CountryHandler;

use tests\LeKoala\Tin\AbstractAlgorithmSpec;

class SpainSpec extends AbstractAlgorithmSpec
{
    public const INVALID_NUMBER_CHECK = 'X1234567Z';

    public const INVALID_NUMBER_LENGTH = '542372254545445A';

    public const INVALID_NUMBER_PATTERN = 'wwwwwwwww';

    public const VALID_NUMBER = ['54237A', 'X1234567L', 'Z1234567R', 'M2812345C'];
}
