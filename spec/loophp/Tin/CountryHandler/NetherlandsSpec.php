<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace spec\loophp\Tin\CountryHandler;

use tests\loophp\Tin\AbstractAlgorithmSpec;

class NetherlandsSpec extends AbstractAlgorithmSpec
{
    public const INVALID_NUMBER_CHECK = '174559435';

    public const INVALID_NUMBER_LENGTH = '1745';

    public const INVALID_NUMBER_PATTERN = 'wwwwwwwww';

    public const VALID_NUMBER = '174559434';
}
