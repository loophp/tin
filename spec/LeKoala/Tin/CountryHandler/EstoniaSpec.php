<?php

declare(strict_types=1);

namespace spec\LeKoala\Tin\CountryHandler;

use tests\LeKoala\Tin\AbstractAlgorithmSpec;

class EstoniaSpec extends AbstractAlgorithmSpec
{
    public const INVALID_NUMBER_DATE = '19913333038';

    public const INVALID_NUMBER_LENGTH = '3710225038';

    public const INVALID_NUMBER_PATTERN = '97102250382';

    public const INVALID_NUMBER_SYNTAX = '37102250383';

    public const VALID_NUMBER = ['37102250382', '32708101201', '46304280206'];
}
