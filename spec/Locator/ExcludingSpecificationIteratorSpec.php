<?php

declare(strict_types=1);

/*
 * This file is part of the ExcludeSpecificationsExtension package.
 *
 * (c) Kamil Kokot <kamil@kokot.me>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\FriendsOfBehat\ExcludeSpecificationsExtension\Locator;

use Behat\Testwork\Specification\SpecificationIterator;
use PhpSpec\ObjectBehavior;

final class ExcludingSpecificationIteratorSpec extends ObjectBehavior
{
    function let(SpecificationIterator $specificationIterator): void
    {
        $this->beConstructedWith($specificationIterator, []);
    }

    function it_is_a_specification_iterator(): void
    {
        $this->shouldImplement(SpecificationIterator::class);
    }
}
