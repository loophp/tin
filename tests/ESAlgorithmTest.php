<?php

namespace LeKoala\Tin\Test;

use LeKoala\Tin\TINValid;
use PHPUnit\Framework\TestCase;

class ESAlgorithmTest extends TestCase
{
    const VALID_NUMBER = '54237A';
    const VALID_NUMBER2 = 'X1234567L';
    const VALID_NUMBER3 = 'Z1234567R';
    const VALID_NUMBER4 = 'M2812345C';
    const INVALID_NUMBER_CHECK = 'X1234567Z';
    const INVALID_NUMBER_LENGTH = '542372254545445A';

    public function testValidNumber()
    {
        $this->assertTrue(TINValid::checkTIN('es', self::VALID_NUMBER));
        $this->assertTrue(TINValid::checkTIN('es', self::VALID_NUMBER2));
        $this->assertTrue(TINValid::checkTIN('es', self::VALID_NUMBER3));
        $this->assertTrue(TINValid::checkTIN('es', self::VALID_NUMBER4));
    }

    public function testInvalidNumber()
    {
        $this->assertFalse(TINValid::checkTIN('es', self::INVALID_NUMBER_CHECK));
        $this->assertFalse(TINValid::checkTIN('es', self::INVALID_NUMBER_LENGTH));
    }
}
