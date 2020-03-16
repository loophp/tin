<?php

declare(strict_types=1);

namespace spec\loophp\Tin\CountryHandler;

use tests\loophp\Tin\AbstractAlgorithmSpec;

class CroatiaSpec extends AbstractAlgorithmSpec
{
    public const INVALID_NUMBER_CHECK = '00123123711';

    public const INVALID_NUMBER_LENGTH = '0123456789101';

    public const INVALID_NUMBER_PATTERN = '1w1w1w1w1w1';

    public const VALID_NUMBER = ['71481280786'];
}
