<?php

namespace LeKoala\Tin\Test;

use LeKoala\Tin\TINValid;
use PHPUnit\Framework\TestCase;

class FRAlgorithmTest extends TestCase
{
    const VALID_NUMBER = '30 23 217 600 053';
    const INVALID_NUMBER_CHECK = '30 23 217 600 052';
    const INVALID_NUMBER_LENGTH = '30 23 217 600 0531';

    public function testValidNumber()
    {
        $this->assertTrue(TINValid::checkTIN('fr', self::VALID_NUMBER));
    }

    public function testInvalidNumber()
    {
        $this->assertFalse(TINValid::checkTIN('fr', self::INVALID_NUMBER_CHECK));
        $this->assertFalse(TINValid::checkTIN('fr', self::INVALID_NUMBER_LENGTH));
    }
}
