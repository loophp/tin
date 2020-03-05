<?php

namespace LeKoala\Tin\Test;

use LeKoala\Tin\TINValid;
use PHPUnit\Framework\TestCase;

class MTAlgorithmTest extends TestCase
{
    const VALID_NUMBER = '1234567A';
    const INVALID_NUMBER_PATTERN = '1234567W';
    const INVALID_NUMBER_LENGTH = '1234567A1';

    public function testValidNumber()
    {
        $this->assertTrue(TINValid::checkTIN('mt', self::VALID_NUMBER));
    }

    public function testInvalidNumber()
    {
        $this->assertFalse(TINValid::checkTIN('mt', self::INVALID_NUMBER_PATTERN));
        $this->assertFalse(TINValid::checkTIN('mt', self::INVALID_NUMBER_LENGTH));
    }
}
