<?php

declare(strict_types=1);

namespace spec\LeKoala\Tin\CountryHandler;

use tests\LeKoala\Tin\AbstractAlgorithmSpec;

/** @todo find a way to remove the dash. */
class FinlandSpec extends AbstractAlgorithmSpec
{
    public const INVALID_NUMBER_CHECK = '131052-308Z';

    public const INVALID_NUMBER_DATE = '191952A308T';

    public const INVALID_NUMBER_LENGTH = '1310552-308T';

    public const INVALID_NUMBER_PATTERN = '1-31052308T';

    public const VALID_NUMBER = '131052-308T';
}
