<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace spec\loophp\Tin\CountryHandler;

use tests\loophp\Tin\AbstractAlgorithmSpec;

class ItalySpec extends AbstractAlgorithmSpec
{
    public const INVALID_NUMBER_CHECK = 'DMLPRY77D15H501B';

    public const INVALID_NUMBER_LENGTH = 'DMLPRY77D154H501F';

    public const INVALID_NUMBER_PATTERN = '1111111111111111';

    public const VALID_NUMBER = 'DMLPRY77D15H501F';
}
