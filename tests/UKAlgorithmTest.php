<?php

namespace LeKoala\Tin\Test;

use LeKoala\Tin\TINValid;
use PHPUnit\Framework\TestCase;

class UKAlgorithmTest extends TestCase
{
    const VALID_NUMBER = '1234567890';
    const VALID_NUMBER2 = 'AA123456A';
    const INVALID_NUMBER_CHECK = 'GB123456A';
    const INVALID_NUMBER_LENGTH = '12345678901';

    public function testValidNumber()
    {
        $this->assertTrue(TINValid::checkTIN('uk', self::VALID_NUMBER));
        $this->assertTrue(TINValid::checkTIN('uk', self::VALID_NUMBER2));
    }

    public function testInvalidNumber()
    {
        $this->assertFalse(TINValid::checkTIN('uk', self::INVALID_NUMBER_CHECK));
        $this->assertFalse(TINValid::checkTIN('uk', self::INVALID_NUMBER_LENGTH));
    }
}
