<?php

namespace LeKoala\Tin\Test;

use LeKoala\Tin\TINValid;
use PHPUnit\Framework\TestCase;

class FIAlgorithmTest extends TestCase
{
    const VALID_NUMBER = '131052-308T';
    const INVALID_NUMBER_CHECK = '131052-308Z';
    const INVALID_NUMBER_LENGTH = '1310552-308T';

    public function testValidNumber()
    {
        $this->assertTrue(TINValid::checkTIN('fi', self::VALID_NUMBER));
    }

    public function testInvalidNumber()
    {
        $this->assertFalse(TINValid::checkTIN('fi', self::INVALID_NUMBER_CHECK));
        $this->assertFalse(TINValid::checkTIN('fi', self::INVALID_NUMBER_LENGTH));
    }
}
