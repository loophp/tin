<?php

declare(strict_types=1);

namespace spec\LeKoala\Tin\CountryHandler;

use tests\LeKoala\Tin\AbstractAlgorithmSpec;

class ItalySpec extends AbstractAlgorithmSpec
{
    public const INVALID_NUMBER_CHECK = 'DMLPRY77D15H501B';

    public const INVALID_NUMBER_LENGTH = 'DMLPRY77D154H501F';

    public const INVALID_NUMBER_PATTERN = '1111111111111111';

    public const VALID_NUMBER = 'DMLPRY77D15H501F';
}
