<?php

namespace LeKoala\Tin\Test;

use LeKoala\Tin\TINValid;
use PHPUnit\Framework\TestCase;

class BEAlgorithmTest extends TestCase
{
    const VALID_NUMBER = '00012511119';
    const VALID_NUMBER2 = '00022911101'; // a valid number in year 2k
    const INVALID_NUMBER_CHECK = '00012511120';
    const INVALID_NUMBER_LENGTH = '0001251112020';

    public function testValidNumber()
    {
        $this->assertTrue(TINValid::checkTIN('be', self::VALID_NUMBER));
        $this->assertTrue(TINValid::checkTIN('be', self::VALID_NUMBER2));
    }

    public function testInvalidNumber()
    {
        $this->assertFalse(TINValid::checkTIN('be', self::INVALID_NUMBER_CHECK));
        $this->assertFalse(TINValid::checkTIN('be', self::INVALID_NUMBER_LENGTH));
    }
}
