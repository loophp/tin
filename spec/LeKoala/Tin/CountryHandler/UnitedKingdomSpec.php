<?php

declare(strict_types=1);

namespace spec\LeKoala\Tin\CountryHandler;

use tests\LeKoala\Tin\AbstractAlgorithmSpec;

class UnitedKingdomSpec extends AbstractAlgorithmSpec
{
    public const INVALID_NUMBER_LENGTH = '12345678901';

    public const INVALID_NUMBER_PATTERN = ['wwwwwwww', 'GB123456A'];

    public const VALID_NUMBER = ['1234567890', 'AA123456A'];
}
