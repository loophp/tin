<?php

namespace LeKoala\Tin\Test;

use LeKoala\Tin\TINValid;
use PHPUnit\Framework\TestCase;

class LUAlgorithmTest extends TestCase
{
    const VALID_NUMBER = '1893120105732';
    const INVALID_NUMBER_CHECK = '1893120105733';
    const INVALID_NUMBER_LENGTH = '18931201057321';

    public function testValidNumber()
    {
        $this->assertTrue(TINValid::checkTIN('lu', self::VALID_NUMBER));
    }

    public function testInvalidNumber()
    {
        $this->assertFalse(TINValid::checkTIN('lu', self::INVALID_NUMBER_CHECK));
        $this->assertFalse(TINValid::checkTIN('lu', self::INVALID_NUMBER_LENGTH));
    }
}
