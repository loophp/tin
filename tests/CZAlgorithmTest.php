<?php

namespace LeKoala\Tin\Test;

use LeKoala\Tin\TINValid;
use PHPUnit\Framework\TestCase;

/**
 * Credits to czechphp for real test data
 *
 * @link https://github.com/czechphp/national-identification-number-validator/blob/master/Tests/NationalIdentificationNumberValidatorTest.php
 */
class CZAlgorithmTest extends TestCase
{
    /**
     * @dataProvider validProvider
     *
     * @param string $value
     * @param $message
     */
    public function testValid(string $value, $message)
    {
        $this->assertTrue(TINValid::checkTIN('cz', $value), $message);
    }

    /**
     * @return array
     */
    public function validProvider()
    {
        return [
            ['000101999', 'spec1'],
            ['000101999C', 'spec2'],
            ['103224/0000', 'male born 2010-12-24 with +20'],
            ['108224/0016', 'female born 2010-12-24 with +20'],
            ['901224/0006', 'male born 1990-12-24'],
            ['906224/0011', 'female born 1990-12-24'],
            ['401224/001', 'male born 1940-12-24'],
            ['406224/002', 'female born 1940-12-24'],
        ];
    }

    public function testInvalidLength()
    {
        $this->assertFalse(
            TINValid::checkTIN('cz', '01224/0006')
        );
    }

    public function testInvalidCharacter()
    {
        $this->assertFalse(
            TINValid::checkTIN('cz', '90A224/0006')
        );
    }

    public function testInvalidMonth()
    {
        $this->assertFalse(
            TINValid::checkTIN('cz', '901524/0006')
        );
    }

    // public function testPlus20InMonthInWrongYear()
    // {
    //     $this->assertFalse(
    //         TINValid::checkTIN('cz', '902124/0003')
    //     );
    // }

    // public function testPlus20InMonthInSeeminglyCorrectYearDifferentiatedByMissingModulo()
    // {
    //     $this->assertFalse(
    //         TINValid::checkTIN('cz', '052124/001')
    //     );
    // }

    public function testDayShouldNotBeZero()
    {
        $this->assertFalse(
            TINValid::checkTIN('cz', '501200/001')
        );
    }

    public function testDayShouldNotBeGreaterThan31()
    {
        $this->assertFalse(
            TINValid::checkTIN('cz', '500132/001')
        );
    }

    // public function testAfterYear53ModuloIsRequired()
    // {
    //     $this->assertFalse(
    //         TINValid::checkTIN('cz', '540101/001')
    //     );
    // }

    // public function testWithoutModuloSequenceShouldNotBeZero()
    // {
    //     $this->assertFalse(
    //         TINValid::checkTIN('cz', '500101/000')
    //     );
    // }

    // public function testIncorrectModulo()
    // {
    //     $this->assertFalse(
    //         TINValid::checkTIN('cz', '540101/0008')
    //     );
    // }

    // public function testIncorrectModuloIsCorrectIfItShouldBe10()
    // {
    //     $this->assertFalse(
    //         TINValid::checkTIN('cz', '540101/0110')
    //     );
    // }
}
