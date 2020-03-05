<?php

namespace LeKoala\Tin\Test;

use LeKoala\Tin\TINValid;
use PHPUnit\Framework\TestCase;

class ITAlgorithmTest extends TestCase
{
    const VALID_NUMBER = 'DMLPRY77D15H501F';
    const INVALID_NUMBER_CHECK = 'DMLPRY77D15H501B';
    const INVALID_NUMBER_LENGTH = 'DMLPRY77D154H501F';

    public function testValidNumber()
    {
        $this->assertTrue(TINValid::checkTIN('it', self::VALID_NUMBER));
    }

    public function testInvalidNumber()
    {
        $this->assertFalse(TINValid::checkTIN('it', self::INVALID_NUMBER_CHECK));
        $this->assertFalse(TINValid::checkTIN('it', self::INVALID_NUMBER_LENGTH));
    }
}
