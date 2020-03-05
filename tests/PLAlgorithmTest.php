<?php

namespace LeKoala\Tin\Test;

use LeKoala\Tin\TINValid;
use PHPUnit\Framework\TestCase;

class PLAlgorithmTest extends TestCase
{
    const VALID_NUMBER = '2234567895';
    const VALID_NUMBER2 = '02070803628';
    const INVALID_NUMBER_CHECK = '2234567894';
    const INVALID_NUMBER_LENGTH = '22345678951';

    public function testValidNumber()
    {
        $this->assertTrue(TINValid::checkTIN('pl', self::VALID_NUMBER));
        $this->assertTrue(TINValid::checkTIN('pl', self::VALID_NUMBER2));
    }

    public function testInvalidNumber()
    {
        $this->assertFalse(TINValid::checkTIN('pl', self::INVALID_NUMBER_CHECK));
        $this->assertFalse(TINValid::checkTIN('pl', self::INVALID_NUMBER_LENGTH));
    }
}
