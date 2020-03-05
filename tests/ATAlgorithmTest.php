<?php

namespace LeKoala\Tin\Test;

use LeKoala\Tin\TINValid;
use PHPUnit\Framework\TestCase;

class ATAlgorithmTest extends TestCase
{
    const VALID_NUMBER = '931736581';
    const INVALID_NUMBER_CHECK = '931736582';
    const INVALID_NUMBER_LENGTH = '9317365815';

    public function testValidNumber()
    {
        $this->assertTrue(TINValid::checkTIN('at', self::VALID_NUMBER));
    }

    public function testInvalidNumber()
    {
        $this->assertFalse(TINValid::checkTIN('at', self::INVALID_NUMBER_CHECK));
        $this->assertFalse(TINValid::checkTIN('at', self::INVALID_NUMBER_LENGTH));
    }
}
