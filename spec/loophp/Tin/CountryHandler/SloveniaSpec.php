<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace spec\loophp\Tin\CountryHandler;

use tests\loophp\Tin\AbstractAlgorithmSpec;

class SloveniaSpec extends AbstractAlgorithmSpec
{
    public const INVALID_NUMBER_CHECK = '15012558';

    public const INVALID_NUMBER_LENGTH = '150125571';

    public const INVALID_NUMBER_PATTERN = 'wwwwwwww';

    public const VALID_NUMBER = '15012557';
}
