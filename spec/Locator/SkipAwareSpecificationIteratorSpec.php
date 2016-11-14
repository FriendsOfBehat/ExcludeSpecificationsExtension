<?php

/*
 * This file is part of the SkipExtension package.
 *
 * (c) Kamil Kokot <kamil@kokot.me>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\FriendsOfBehat\SkipExtension\Locator;

use Behat\Testwork\Specification\SpecificationIterator;
use PhpSpec\ObjectBehavior;

final class SkipAwareSpecificationIteratorSpec extends ObjectBehavior
{
    function let(SpecificationIterator $specificationIterator)
    {
        $this->beConstructedWith($specificationIterator, []);
    }

    function it_is_a_specification_iterator()
    {
        $this->shouldImplement(SpecificationIterator::class);
    }
}
