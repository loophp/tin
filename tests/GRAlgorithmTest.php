<?php

namespace LeKoala\Tin\Test;

use LeKoala\Tin\TINValid;
use PHPUnit\Framework\TestCase;

class GRAlgorithmTest extends TestCase
{
    const VALID_NUMBER = '123456789';
    const INVALID_NUMBER_LENGTH = '12345678';

    public function testValidNumber()
    {
        $this->assertTrue(TINValid::checkTIN('gr', self::VALID_NUMBER));
    }

    public function testInvalidNumber()
    {
        $this->assertFalse(TINValid::checkTIN('gr', self::INVALID_NUMBER_LENGTH));
    }
}
