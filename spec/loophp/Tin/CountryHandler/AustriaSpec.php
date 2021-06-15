<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace spec\loophp\Tin\CountryHandler;

use tests\loophp\Tin\AbstractAlgorithmSpec;

class AustriaSpec extends AbstractAlgorithmSpec
{
    public const INVALID_NUMBER_CHECK = '931736582';

    public const INVALID_NUMBER_LENGTH = '9317365815';

    public const INVALID_NUMBER_PATTERN = ['1w1w1w1w1'];

    public const VALID_NUMBER = '931736581';
}
