<?php

declare(strict_types=1);

namespace spec\loophp\Tin\CountryHandler;

use tests\loophp\Tin\AbstractAlgorithmSpec;

class PortugalSpec extends AbstractAlgorithmSpec
{
    public const INVALID_NUMBER_CHECK = '299999995';

    public const INVALID_NUMBER_LENGTH = '2999999981';

    public const INVALID_NUMBER_PATTERN = 'wwwwwwwww';

    public const VALID_NUMBER = '299999998';
}
