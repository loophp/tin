<?php

declare(strict_types=1);

namespace spec\loophp\Tin\CountryHandler;

use tests\loophp\Tin\AbstractAlgorithmSpec;

class CyprusSpec extends AbstractAlgorithmSpec
{
    public const INVALID_NUMBER_CHECK = '09999999T';

    public const INVALID_NUMBER_LENGTH = '00123123TZ';

    public const INVALID_NUMBER_PATTERN = 'wwwwwwwww';

    public const INVALID_NUMBER_SYNTAX = ['99652159X', '94444444X', '97777777X', '98888888X'];

    public const VALID_NUMBER = ['00123123T', '99652156X'];
}
