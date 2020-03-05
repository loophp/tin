<?php

namespace LeKoala\Tin\Test;

use LeKoala\Tin\TINValid;
use PHPUnit\Framework\TestCase;

class BGAlgorithmTest extends TestCase
{
    const VALID_NUMBER = '7501010010';
    const INVALID_NUMBER_CHECK = '7501010011';
    const INVALID_NUMBER_LENGTH = '75010100100';

    public function testValidNumber()
    {
        $this->assertTrue(TINValid::checkTIN('bg', self::VALID_NUMBER));
    }

    public function testInvalidNumber()
    {
        $this->assertFalse(TINValid::checkTIN('bg', self::INVALID_NUMBER_CHECK));
        $this->assertFalse(TINValid::checkTIN('bg', self::INVALID_NUMBER_LENGTH));
    }
}
