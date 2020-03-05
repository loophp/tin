<?php

namespace LeKoala\Tin\Test;

use LeKoala\Tin\TINValid;
use PHPUnit\Framework\TestCase;

class NLAlgorithmTest extends TestCase
{
    const VALID_NUMBER = '174559434';
    const INVALID_NUMBER_CHECK = '174559435';
    const INVALID_NUMBER_LENGTH = '1745594341';

    public function testValidNumber()
    {
        $this->assertTrue(TINValid::checkTIN('nl', self::VALID_NUMBER));
    }

    public function testInvalidNumber()
    {
        $this->assertFalse(TINValid::checkTIN('nl', self::INVALID_NUMBER_CHECK));
        $this->assertFalse(TINValid::checkTIN('nl', self::INVALID_NUMBER_LENGTH));
    }
}
