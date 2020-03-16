<?php

declare(strict_types=1);

namespace spec\loophp\Tin\CountryHandler;

use tests\loophp\Tin\AbstractAlgorithmSpec;

class LithuaniaSpec extends AbstractAlgorithmSpec
{
    public const INVALID_NUMBER_CHECK = ['10101010004', '10101010051'];

    public const INVALID_NUMBER_LENGTH = '101010100051';

    public const INVALID_NUMBER_PATTERN = 'wwwwwwwwwww';

    public const VALID_NUMBER = '10101010005';
}
