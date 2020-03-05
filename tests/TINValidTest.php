<?php

namespace LeKoala\Tin\Test;

use LeKoala\Tin\TINValid;
use PHPUnit\Framework\TestCase;

class TINValidTest extends TestCase
{
    public function testSupportedCountries()
    {
        $this->assertTrue(TINValid::isCountrySupported('be'));
        $this->assertFalse(TINValid::isCountrySupported('cn'));
    }

    public function testCheckTin()
    {
        $this->assertIsBool(TINValid::checkTIN('be', '00012511119'));
    }
}
