<?php

namespace LeKoala\Tin\Test;

use LeKoala\Tin\TINValid;
use PHPUnit\Framework\TestCase;

class SKAlgorithmTest extends TestCase
{
    const VALID_NUMBER = '7711167420';
    const VALID_NUMBER2 = '281203054';
    const INVALID_NUMBER_LENGTH = '77111674201';

    public function testValidNumber()
    {
        $this->assertTrue(TINValid::checkTIN('sk', self::VALID_NUMBER));
        $this->assertTrue(TINValid::checkTIN('sk', self::VALID_NUMBER2));
    }

    public function testInvalidNumber()
    {
        $this->assertFalse(TINValid::checkTIN('sk', self::INVALID_NUMBER_LENGTH));
    }
}
