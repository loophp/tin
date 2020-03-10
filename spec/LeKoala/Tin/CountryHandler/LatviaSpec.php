<?php

declare(strict_types=1);

namespace spec\LeKoala\Tin\CountryHandler;

use tests\LeKoala\Tin\AbstractAlgorithmSpec;

class LatviaSpec extends AbstractAlgorithmSpec
{
    public const INVALID_NUMBER_DATE = ['31999999999'];

    public const INVALID_NUMBER_LENGTH = '325794610055';

    public const VALID_NUMBER = ['01011012345', '32579461005'];
}
