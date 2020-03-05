<?php

namespace LeKoala\Tin\Test;

use LeKoala\Tin\TINValid;
use PHPUnit\Framework\TestCase;

class DKAlgorithmTest extends TestCase
{
    const VALID_NUMBER = '010111-1113';
    const VALID_NUMBER2 = '010160-1111';
    const INVALID_NUMBER_CHECK = '010111-1114';
    const INVALID_NUMBER_LENGTH = '010111-11132';
    const INVALID_NUMBER_PATTERN = '010260-1111';

    public function testValidNumber()
    {
        $this->assertTrue(TINValid::checkTIN('dk', self::VALID_NUMBER));
        $this->assertTrue(TINValid::checkTIN('dk', self::VALID_NUMBER2));
    }

    public function testInvalidNumber()
    {
        $this->assertFalse(TINValid::checkTIN('dk', self::INVALID_NUMBER_CHECK));
        $this->assertFalse(TINValid::checkTIN('dk', self::INVALID_NUMBER_LENGTH));
        $this->assertFalse(TINValid::checkTIN('dk', self::INVALID_NUMBER_PATTERN));
    }
}
