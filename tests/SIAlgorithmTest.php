<?php

namespace LeKoala\Tin\Test;

use LeKoala\Tin\TINValid;
use PHPUnit\Framework\TestCase;

class SIAlgorithmTest extends TestCase
{
    const VALID_NUMBER = '15012557';
    const INVALID_NUMBER_CHECK = '15012558';
    const INVALID_NUMBER_LENGTH = '150125571';

    public function testValidNumber()
    {
        $this->assertTrue(TINValid::checkTIN('si', self::VALID_NUMBER));
    }

    public function testInvalidNumber()
    {
        $this->assertFalse(TINValid::checkTIN('si', self::INVALID_NUMBER_CHECK));
        $this->assertFalse(TINValid::checkTIN('si', self::INVALID_NUMBER_LENGTH));
    }
}
