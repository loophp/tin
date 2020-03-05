# Taxpayer Identification Number (TIN) Validator

[![Build Status](https://travis-ci.org/lekoala/tin.svg?branch=master)](https://travis-ci.org/lekoala/tin)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/lekoala/tin/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/lekoala/tin/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/lekoala/tin/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/lekoala/tin/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/lekoala/tin/badges/build.png?b=master)](https://scrutinizer-ci.com/g/lekoala/tin/build-status/master)
[![codecov.io](https://codecov.io/github/lekoala/tin/coverage.svg?branch=master)](https://codecov.io/github/lekoala/tin?branch=master)

[![Latest Stable Version](https://poser.pugx.org/lekoala/tin/version)](https://packagist.org/packages/lekoala/tin)
[![Latest Unstable Version](https://poser.pugx.org/lekoala/tin/v/unstable)](//packagist.org/packages/lekoala/tin)
[![Total Downloads](https://poser.pugx.org/lekoala/tin/downloads)](https://packagist.org/packages/lekoala/tin)
[![License](https://poser.pugx.org/lekoala/tin/license)](https://packagist.org/packages/lekoala/tin)
[![Monthly Downloads](https://poser.pugx.org/lekoala/tin/d/monthly)](https://packagist.org/packages/lekoala/tin)
[![Daily Downloads](https://poser.pugx.org/lekoala/tin/d/daily)](https://packagist.org/packages/lekoala/tin)

[![Dependency Status](https://www.versioneye.com/php/lekoala:tin/badge.svg)](https://www.versioneye.com/php/lekoala:tin)
[![Reference Status](https://www.versioneye.com/php/lekoala:tin/reference_badge.svg?style=flat)](https://www.versioneye.com/php/lekoala:tin/references)

A library to validate TIN numbers for individuals. This is based on a java library,
this is why the code does not reflect best practices in php.

Supported countries are:
- Austria (AT)
- Belgium (BE)
- Bulgaria (BG)
- Croatia (HR)
- Cyprus (CY)
- Czech Republic (CZ) - no check digit (but possible czechphp/national-identification-number-validator)
- Denmark (DK)
- Estonia (EE)
- Finland (FI)
- France (FR)
- Germany (DE)
- Greece (GR) - only size
- Hungary (HU)
- Ireland (IE)
- Italy (IT)
- Latvia (LV) - no check digit
- Lithuania	(LT)
- Luxembourg (LU)
- Malta (MT) - no check digit
- Netherlands (NL)
- Poland (PL)
- Portugal (PT)
- Romania (RO) - no check digit
- Slovakia (SK) - only structure
- Slovenia (SI)
- Spain (ES)
- Sweden (SE)
- United Kingdom (UK) - only structure

If your country is not there, feel free to open an issue with your country code and
a link to the specification. Ideally, if you can provide a PR with the algorithm and the
test that would be even better :-)

## Installation

Run

```
$ composer require lekoala/tin
```

## Usage

To simply check the validity of a number

    $result = TINValid::checkTIN($countryCode, $number);

If you want to get the reason why a number is invalid, you can use

    try {
        TINValid::validateTIN($countryCode, $number);
    }
    catch(TINValidationException $e) {
        
    }

If you want to see if a country is supported or not, you can simply use

    $result = TINValid::isCountrySupported('be');

## Links

[`TIN Algorithms - Public - Functional Specification`](<https://ec.europa.eu/taxation_customs/tin/specs/FS-TIN Algorithms-Public.docx>)

[`Taxpayer Identification Number`](https://en.wikipedia.org/wiki/Taxpayer_Identification_Number)

## License

This package is licensed using the MIT License.
Please have a look at [`LICENSE.md`](LICENSE.md).
