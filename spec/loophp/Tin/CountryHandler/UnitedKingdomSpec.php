<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace spec\loophp\Tin\CountryHandler;

use tests\loophp\Tin\AbstractAlgorithmSpec;

class UnitedKingdomSpec extends AbstractAlgorithmSpec
{
    public const INVALID_NUMBER_LENGTH = '12345678901';

    public const INVALID_NUMBER_PATTERN = ['wwwwwwww', 'GB123456A'];

    public const VALID_NUMBER = ['1234567890', 'AA123456A'];
}
