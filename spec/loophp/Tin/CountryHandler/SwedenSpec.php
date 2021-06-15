<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace spec\loophp\Tin\CountryHandler;

use tests\loophp\Tin\AbstractAlgorithmSpec;

class SwedenSpec extends AbstractAlgorithmSpec
{
    public const INVALID_NUMBER_CHECK = '6408233235';

    public const INVALID_NUMBER_LENGTH = '64082332341';

    public const INVALID_NUMBER_PATTERN = 'wwwwwwwwww';

    public const VALID_NUMBER = ['6408233234', '6408833231', '196408233234', '196408833231'];
}
