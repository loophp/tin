<?php

namespace LeKoala\Tin\Test;

use LeKoala\Tin\TINValid;
use PHPUnit\Framework\TestCase;

class HRAlgorithmTest extends TestCase
{
    const VALID_NUMBER = '94577403194';
    const INVALID_NUMBER_CHECK = '94577403195';
    const INVALID_NUMBER_LENGTH = '9457740319';

    public function testValidNumber()
    {
        $this->assertTrue(TINValid::checkTIN('hr', self::VALID_NUMBER));
    }

    public function testInvalidNumber()
    {
        $this->assertFalse(TINValid::checkTIN('hr', self::INVALID_NUMBER_CHECK));
        $this->assertFalse(TINValid::checkTIN('hr', self::INVALID_NUMBER_LENGTH));
    }
}
