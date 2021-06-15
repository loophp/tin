<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace spec\loophp\Tin;

use loophp\Tin\Exception\TINException;
use loophp\Tin\TIN;
use PhpSpec\ObjectBehavior;

class TINSpec extends ObjectBehavior
{
    public function it_can_be_constructed_from_a_countrycode_and_tin()
    {
        $this
            ->beConstructedThrough('from', ['be', '1234567890']);

        $this
            ->shouldBeAnInstanceOf(TIN::class);
    }

    public function it_can_be_constructed_from_a_slug()
    {
        $this
            ->beConstructedThrough('fromSlug', ['be1234567890']);

        $this
            ->shouldBeAnInstanceOf(TIN::class);
    }

    public function it_can_check_if_a_tin_is_valid_or_not()
    {
        $this
            ->beConstructedThrough('from', ['be', '1234567890']);

        $this::fromSlug('be123456789')
            ->isValid()
            ->shouldReturn(false);

        $this::fromSlug('be00012511119')
            ->isValid()
            ->shouldReturn(true);
    }

    public function it_can_throw_an_exception_if_algorithm_is_not_found()
    {
        $this::fromSlug('foo1234')
            ->shouldThrow(TINException::class)
            ->during('check');

        $this::fromSlug('ww1234')
            ->shouldThrow(TINException::class)
            ->during('check');

        $this::fromSlug('ww')
            ->shouldThrow(TINException::class)
            ->during('check');

        $this::fromSlug('1234')
            ->shouldThrow(TINException::class)
            ->during('check');
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(TIN::class);
    }

    public function let()
    {
        $this->beConstructedThrough('fromSlug', ['foo123']);
    }
}
