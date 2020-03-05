<?php

namespace LeKoala\Tin\Test;

use LeKoala\Tin\TINValid;
use PHPUnit\Framework\TestCase;

class EEAlgorithmTest extends TestCase
{
    const VALID_NUMBER = '37102250382';
    const VALID_NUMBER2 = '32708101201';
    const VALID_NUMBER3 = '46304280206';
    const INVALID_NUMBER_CHECK = '37102250383';
    const INVALID_NUMBER_LENGTH = '3710225038';

    public function testValidNumber()
    {
        $this->assertTrue(TINValid::checkTIN('ee', self::VALID_NUMBER));
        $this->assertTrue(TINValid::checkTIN('ee', self::VALID_NUMBER2));
        $this->assertTrue(TINValid::checkTIN('ee', self::VALID_NUMBER3));
    }

    public function testInvalidNumber()
    {
        $this->assertFalse(TINValid::checkTIN('ee', self::INVALID_NUMBER_CHECK));
        $this->assertFalse(TINValid::checkTIN('ee', self::INVALID_NUMBER_LENGTH));
    }
}
