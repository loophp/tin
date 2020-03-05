<?php

namespace LeKoala\Tin\Test;

use LeKoala\Tin\TINValid;
use PHPUnit\Framework\TestCase;

class LTAlgorithmTest extends TestCase
{
    const VALID_NUMBER = '10101010005';
    const INVALID_NUMBER_CHECK = '10101010004';
    const INVALID_NUMBER_LENGTH = '101010100051';

    public function testValidNumber()
    {
        $this->assertTrue(TINValid::checkTIN('lt', self::VALID_NUMBER));
    }

    public function testInvalidNumber()
    {
        $this->assertFalse(TINValid::checkTIN('lt', self::INVALID_NUMBER_CHECK));
        $this->assertFalse(TINValid::checkTIN('lt', self::INVALID_NUMBER_LENGTH));
    }
}
