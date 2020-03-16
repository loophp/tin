<?php

declare(strict_types=1);

namespace spec\loophp\Tin\CountryHandler;

use tests\loophp\Tin\AbstractAlgorithmSpec;

class HungarySpec extends AbstractAlgorithmSpec
{
    public const INVALID_NUMBER_CHECK = '8071592154';

    public const INVALID_NUMBER_LENGTH = '80715921531';

    public const INVALID_NUMBER_PATTERN = '1111111111';

    public const VALID_NUMBER = '8071592153';
}
