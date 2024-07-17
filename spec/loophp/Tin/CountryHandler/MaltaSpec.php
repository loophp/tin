<?php

declare(strict_types=1);

namespace spec\loophp\Tin\CountryHandler;

use tests\loophp\Tin\AbstractAlgorithmSpec;

class MaltaSpec extends AbstractAlgorithmSpec
{
    public const INVALID_NUMBER_LENGTH = '1234567A1';

    public const INVALID_NUMBER_SYNTAX = '1234567W';

    public const VALID_NUMBER = '1234567A';
}
