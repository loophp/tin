<?php

namespace LeKoala\Tin\Test;

use LeKoala\Tin\TINValid;
use PHPUnit\Framework\TestCase;

class LVAlgorithmTest extends TestCase
{
    const VALID_NUMBER = '01011012345';
    const VALID_NUMBER2 = '32579461005';
    const INVALID_NUMBER_LENGTH = '325794610055';

    public function testValidNumber()
    {
        $this->assertTrue(TINValid::checkTIN('lv', self::VALID_NUMBER));
        $this->assertTrue(TINValid::checkTIN('lv', self::VALID_NUMBER2));
    }

    public function testInvalidNumber()
    {
        $this->assertFalse(TINValid::checkTIN('lv', self::INVALID_NUMBER_LENGTH));
    }
}
