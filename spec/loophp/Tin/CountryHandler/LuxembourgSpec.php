<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace spec\loophp\Tin\CountryHandler;

use tests\loophp\Tin\AbstractAlgorithmSpec;

class LuxembourgSpec extends AbstractAlgorithmSpec
{
    public const INVALID_NUMBER_CHECK = '1893120105733';

    public const INVALID_NUMBER_LENGTH = '18931201057321';

    public const INVALID_NUMBER_PATTERN = 'wwwwwwwwwwwww';

    public const VALID_NUMBER = '1893120105732';
}
