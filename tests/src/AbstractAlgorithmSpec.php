<?php

declare(strict_types=1);

namespace tests\LeKoala\Tin;

use LeKoala\Tin\Exception\TINException;
use PhpSpec\Exception\Example\SkippingException;
use PhpSpec\ObjectBehavior;

use function get_class;

abstract class AbstractAlgorithmSpec extends ObjectBehavior
{
    public const INVALID_NUMBER_CHECK = [];

    public const INVALID_NUMBER_DATE = [];

    public const INVALID_NUMBER_LENGTH = [];

    public const INVALID_NUMBER_PATTERN = [];

    public const INVALID_NUMBER_SYNTAX = [];

    public const VALID_NUMBER = [];

    public function it_can_throw_an_exception_if_tin_has_invalid_date()
    {
        $numbers = (array) $this::INVALID_NUMBER_DATE;

        if ([] === $numbers) {
            throw new SkippingException('Missing tests for date validation.');
        }

        foreach ($numbers as $number) {
            $this
                ->withTIN(mb_strtoupper($number))
                ->shouldThrow(new TINException('Invalid date.'))
                ->during('validate');

            $this
                ->withTIN(mb_strtolower($number))
                ->shouldThrow(new TINException('Invalid date.'))
                ->during('validate');
        }
    }

    public function it_can_throw_an_exception_if_tin_has_invalid_length()
    {
        $numbers = (array) $this::INVALID_NUMBER_LENGTH;

        if ([] === $numbers) {
            throw new SkippingException('Missing tests for length validation.');
        }

        foreach ($numbers as $number) {
            $this
                ->withTIN(mb_strtoupper($number))
                ->shouldThrow(new TINException('Invalid length.'))
                ->during('validate');

            $this
                ->withTIN(mb_strtolower($number))
                ->shouldThrow(new TINException('Invalid length.'))
                ->during('validate');
        }
    }

    public function it_can_throw_an_exception_if_tin_has_invalid_number_check()
    {
        $numbers = (array) $this::INVALID_NUMBER_CHECK;

        if ([] === $numbers) {
            throw new SkippingException('Missing tests for number check validation.');
        }

        foreach ($numbers as $number) {
            $this
                ->withTIN(mb_strtoupper($number))
                ->shouldThrow(new TINException('Invalid syntax.'))
                ->during('validate');

            $this
                ->withTIN(mb_strtolower($number))
                ->shouldThrow(new TINException('Invalid syntax.'))
                ->during('validate');
        }
    }

    public function it_can_throw_an_exception_if_tin_has_invalid_pattern()
    {
        $numbers = (array) $this::INVALID_NUMBER_PATTERN;

        if ([] === $numbers) {
            throw new SkippingException('Missing tests for pattern validation.');
        }

        foreach ($numbers as $number) {
            $this
                ->withTIN(mb_strtoupper($number))
                ->shouldThrow(new TINException('Invalid pattern.'))
                ->during('validate');

            $this
                ->withTIN(mb_strtolower($number))
                ->shouldThrow(new TINException('Invalid pattern.'))
                ->during('validate');
        }
    }

    public function it_can_throw_an_exception_if_tin_has_invalid_syntax()
    {
        $numbers = (array) $this::INVALID_NUMBER_SYNTAX;

        if ([] === $numbers) {
            throw new SkippingException('Missing tests for syntax validation.');
        }

        foreach ($numbers as $number) {
            $this
                ->withTIN(mb_strtoupper($number))
                ->shouldThrow(new TINException('Invalid syntax.'))
                ->during('validate');

            $this
                ->withTIN(mb_strtolower($number))
                ->shouldThrow(new TINException('Invalid syntax.'))
                ->during('validate');
        }
    }

    public function it_can_use_withTIN_and_return_a_new_object()
    {
        $this
            ->withTIN('BE1234567890')
            ->shouldNotReturn($this);
    }

    public function it_can_validate()
    {
        $numbers = (array) $this::VALID_NUMBER;

        if ([] === $numbers) {
            throw new SkippingException('Missing tests for number validation.');
        }

        foreach ($numbers as $number) {
            $this
                ->withTIN(mb_strtolower($number))
                ->validate($number)
                ->shouldReturn(true);

            $this
                ->withTIN(mb_strtoupper($number))
                ->validate($number)
                ->shouldReturn(true);
        }
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(get_class($this->getWrappedObject()));
    }
}
