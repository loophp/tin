<?php

declare(strict_types=1);

namespace spec\LeKoala\Tin\CountryHandler;

use tests\LeKoala\Tin\AbstractAlgorithmSpec;

class SwedenSpec extends AbstractAlgorithmSpec
{
    public const INVALID_NUMBER_CHECK = '6408233235';

    public const INVALID_NUMBER_LENGTH = '64082332341';

    public const INVALID_NUMBER_PATTERN = 'wwwwwwwwww';

    public const VALID_NUMBER = ['6408233234', '6408833231', '196408233234', '196408833231'];
}
