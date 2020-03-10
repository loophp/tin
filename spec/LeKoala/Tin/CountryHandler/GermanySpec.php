<?php

declare(strict_types=1);

namespace spec\LeKoala\Tin\CountryHandler;

use tests\LeKoala\Tin\AbstractAlgorithmSpec;

class GermanySpec extends AbstractAlgorithmSpec
{
    public const INVALID_NUMBER_CHECK = '26954371828';

    public const INVALID_NUMBER_LENGTH = '860957427199';

    public const INVALID_NUMBER_PATTERN = 'wwwwwwwwwww';

    public const VALID_NUMBER = ['26954371827', '86095742719', '65929970489'];
}
