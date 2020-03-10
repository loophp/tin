<?php

declare(strict_types=1);

namespace spec\LeKoala\Tin\CountryHandler;

use tests\LeKoala\Tin\AbstractAlgorithmSpec;

class IrelandSpec extends AbstractAlgorithmSpec
{
    public const INVALID_NUMBER_CHECK = ['1234567S', '1234567s'];

    public const INVALID_NUMBER_LENGTH = ['234567T', '234567t'];

    public const INVALID_NUMBER_PATTERN = ['AAAAAAAA'];

    public const VALID_NUMBER = [
        '1234567T',
        '1234567TW',
        '1234577W',
        '1234577WW',
        '1234577IA',
        '1234567t',
        '1234567tw',
        '1234577w',
        '1234577ww',
        '1234577ia',
    ];
}
