<?php

declare(strict_types=1);

namespace spec\LeKoala\Tin\CountryHandler;

use tests\LeKoala\Tin\AbstractAlgorithmSpec;

class CzeckRepublicSpec extends AbstractAlgorithmSpec
{
    public const INVALID_NUMBER_DATE = ['901549/0006', '902149/0003'];

    public const INVALID_NUMBER_LENGTH = ['1'];

    public const INVALID_NUMBER_PATTERN = ['wwwwww/www'];

    public const INVALID_NUMBER_SYNTAX = [
        '8109024/001',
    ];

    public const VALID_NUMBER = [
        '000101999',
        '103224/0000',
        '108224/0016',
        '901224/0006',
        '906224/0011',
        '401224/001',
        '406224/002',
    ];
}
