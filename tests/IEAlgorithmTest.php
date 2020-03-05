<?php

namespace LeKoala\Tin\Test;

use LeKoala\Tin\TINValid;
use PHPUnit\Framework\TestCase;

class IEAlgorithmTest extends TestCase
{
    const VALID_NUMBER = '1234567T';
    const VALID_NUMBER2 = '1234567TW';
    const VALID_NUMBER3 = '1234577W';
    const VALID_NUMBER4 = '1234577WW';
    const VALID_NUMBER5 = '1234577IA';
    const INVALID_NUMBER_CHECK = '1234567S';
    const INVALID_NUMBER_LENGTH = '234567T';

    public function testValidNumber()
    {
        $this->assertTrue(TINValid::checkTIN('ie', self::VALID_NUMBER));
        $this->assertTrue(TINValid::checkTIN('ie', self::VALID_NUMBER2));
        $this->assertTrue(TINValid::checkTIN('ie', self::VALID_NUMBER3));
        $this->assertTrue(TINValid::checkTIN('ie', self::VALID_NUMBER4));
        $this->assertTrue(TINValid::checkTIN('ie', self::VALID_NUMBER5));
    }

    public function testInvalidNumber()
    {
        $this->assertFalse(TINValid::checkTIN('ie', self::INVALID_NUMBER_CHECK));
        $this->assertFalse(TINValid::checkTIN('ie', self::INVALID_NUMBER_LENGTH));
    }
}
