<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace spec\loophp\Tin\CountryHandler;

use tests\loophp\Tin\AbstractAlgorithmSpec;

class EstoniaSpec extends AbstractAlgorithmSpec
{
    public const INVALID_NUMBER_DATE = '19913333038';

    public const INVALID_NUMBER_LENGTH = '3710225038';

    public const INVALID_NUMBER_PATTERN = '97102250382';

    public const INVALID_NUMBER_SYNTAX = '37102250383';

    public const VALID_NUMBER = ['37102250382', '32708101201', '46304280206'];
}
