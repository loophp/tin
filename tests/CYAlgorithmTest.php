<?php

namespace LeKoala\Tin\Test;

use LeKoala\Tin\TINValid;
use PHPUnit\Framework\TestCase;

class CYAlgorithmTest extends TestCase
{
    const VALID_NUMBER = '00123123T';
    const VALID_NUMBER2 = '99652156X';
    const INVALID_NUMBER_CHECK = '001231237';
    const INVALID_NUMBER_LENGTH = '00123123TZ';

    public function testValidNumber()
    {
        $this->assertTrue(TINValid::checkTIN('cy', self::VALID_NUMBER));
        $this->assertTrue(TINValid::checkTIN('cy', self::VALID_NUMBER2));
    }

    public function testInvalidNumber()
    {
        $this->assertFalse(TINValid::checkTIN('cy', self::INVALID_NUMBER_CHECK));
        $this->assertFalse(TINValid::checkTIN('cy', self::INVALID_NUMBER_LENGTH));
    }
}
