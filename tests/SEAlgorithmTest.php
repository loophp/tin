<?php

namespace LeKoala\Tin\Test;

use LeKoala\Tin\TINValid;
use PHPUnit\Framework\TestCase;

class SEAlgorithmTest extends TestCase
{
    const VALID_NUMBER = '640823-3234';
    const VALID_NUMBER2 = '640883-3231';
    const VALID_NUMBER3 = '19640823-3234';
    const VALID_NUMBER4 = '19640883-3231';
    const INVALID_NUMBER_CHECK = '640823-3235';
    const INVALID_NUMBER_LENGTH = '640823-32341';

    public function testValidNumber()
    {
        $this->assertTrue(TINValid::checkTIN('se', self::VALID_NUMBER));
        $this->assertTrue(TINValid::checkTIN('se', self::VALID_NUMBER2));
        $this->assertTrue(TINValid::checkTIN('se', self::VALID_NUMBER3));
        $this->assertTrue(TINValid::checkTIN('se', self::VALID_NUMBER4));
    }

    public function testInvalidNumber()
    {
        $this->assertFalse(TINValid::checkTIN('se', self::INVALID_NUMBER_CHECK));
        $this->assertFalse(TINValid::checkTIN('se', self::INVALID_NUMBER_LENGTH));
    }
}
