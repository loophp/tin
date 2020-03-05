<?php

namespace LeKoala\Tin\Test;

use LeKoala\Tin\TINValid;
use PHPUnit\Framework\TestCase;

class ROAlgorithmTest extends TestCase
{
    const VALID_NUMBER = '8001011234567';
    const INVALID_NUMBER_LENGTH = '80010112345671';
    const INVALID_NUMBER_DATE = '8001611234567';

    public function testValidNumber()
    {
        $this->assertTrue(TINValid::checkTIN('ro', self::VALID_NUMBER));
    }

    public function testInvalidNumber()
    {
        $this->assertFalse(TINValid::checkTIN('ro', self::INVALID_NUMBER_LENGTH));
        $this->assertFalse(TINValid::checkTIN('ro', self::INVALID_NUMBER_DATE));
    }
}
