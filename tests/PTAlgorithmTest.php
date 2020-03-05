<?php

namespace LeKoala\Tin\Test;

use LeKoala\Tin\TINValid;
use PHPUnit\Framework\TestCase;

class PTAlgorithmTest extends TestCase
{
    const VALID_NUMBER = '299999998';
    const INVALID_NUMBER_CHECK = '299999995';
    const INVALID_NUMBER_LENGTH = '2999999981';

    public function testValidNumber()
    {
        $this->assertTrue(TINValid::checkTIN('pt', self::VALID_NUMBER));
    }

    public function testInvalidNumber()
    {
        $this->assertFalse(TINValid::checkTIN('pt', self::INVALID_NUMBER_CHECK));
        $this->assertFalse(TINValid::checkTIN('pt', self::INVALID_NUMBER_LENGTH));
    }
}
