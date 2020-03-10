<?php

declare(strict_types=1);

namespace spec\LeKoala\Tin\CountryHandler;

use tests\LeKoala\Tin\AbstractAlgorithmSpec;

class BulgariaSpec extends AbstractAlgorithmSpec
{
    public const INVALID_NUMBER_CHECK = '7501010011';

    public const INVALID_NUMBER_DATE = ['7502300010', '4545454545'];

    public const INVALID_NUMBER_LENGTH = '75010100100';

    public const INVALID_NUMBER_PATTERN = ['1w1w1w1w1w'];

    public const VALID_NUMBER = '7501010010';
}
