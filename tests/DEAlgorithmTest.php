<?php

namespace LeKoala\Tin\Test;

use LeKoala\Tin\TINValid;
use PHPUnit\Framework\TestCase;

class DEAlgorithmTest extends TestCase
{
    const VALID_NUMBER = '26954371827';
    const VALID_NUMBER2 = '86095742719';
    const VALID_NUMBER3 = '65929970489';
    const INVALID_NUMBER_ZERO = '06954371827';
    const INVALID_NUMBER_CHECK = '26954371828';
    const INVALID_NUMBER_LENGTH = '860957427199';

    public function testValidNumber()
    {
        $this->assertTrue(TINValid::checkTIN('de', self::VALID_NUMBER));
        $this->assertTrue(TINValid::checkTIN('de', self::VALID_NUMBER2));
        $this->assertTrue(TINValid::checkTIN('de', self::VALID_NUMBER3));
    }

    public function testInvalidNumber()
    {
        $this->assertFalse(TINValid::checkTIN('de', self::INVALID_NUMBER_ZERO));
        $this->assertFalse(TINValid::checkTIN('de', self::INVALID_NUMBER_CHECK));
        $this->assertFalse(TINValid::checkTIN('de', self::INVALID_NUMBER_LENGTH));
    }
}
