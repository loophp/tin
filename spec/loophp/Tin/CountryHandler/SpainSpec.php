<?php

declare(strict_types=1);

namespace spec\loophp\Tin\CountryHandler;

use tests\loophp\Tin\AbstractAlgorithmSpec;

class SpainSpec extends AbstractAlgorithmSpec
{
    public const INVALID_NUMBER_CHECK = ['X1234567Z', 'P2009300B', 'K0867756J'];

    public const INVALID_NUMBER_LENGTH = '542372254545445A';

    public const INVALID_NUMBER_PATTERN = ['wwwwwwwww', 'K0867756N'];

    public const VALID_NUMBER = ['54237A', 'X1234567L', 'Y1234567X', 'Z1234567R', 'M2812345C', 'B05327986', 'P2009300A', 'K0867756I'];
}
