<?php

namespace LeKoala\Tin\Test;

use LeKoala\Tin\TINValid;
use PHPUnit\Framework\TestCase;

class HUAlgorithmTest extends TestCase
{
    const VALID_NUMBER = '8071592153';
    const INVALID_NUMBER_CHECK = '8071592154';
    const INVALID_NUMBER_LENGTH = '80715921531';

    public function testValidNumber()
    {
        $this->assertTrue(TINValid::checkTIN('hu', self::VALID_NUMBER));
    }

    public function testInvalidNumber()
    {
        $this->assertFalse(TINValid::checkTIN('hu', self::INVALID_NUMBER_CHECK));
        $this->assertFalse(TINValid::checkTIN('hu', self::INVALID_NUMBER_LENGTH));
    }
}
