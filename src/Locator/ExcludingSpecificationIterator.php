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

namespace FriendsOfBehat\ExcludeSpecificationsExtension\Locator;

use Behat\Testwork\Specification\SpecificationIterator;
use Behat\Testwork\Suite\Suite;

/**
 * @internal
 */
final class ExcludingSpecificationIterator extends \FilterIterator implements SpecificationIterator
{
    /**
     * @var SpecificationIterator
     */
    private $specificationIterator;

    /**
     * @var array
     */
    private $skippedPaths;

    /**
     * @param SpecificationIterator $specificationIterator
     * @param array $skippedPaths
     */
    public function __construct(SpecificationIterator $specificationIterator, array $skippedPaths)
    {
        parent::__construct($specificationIterator);

        $this->specificationIterator = $specificationIterator;
        $this->skippedPaths = $skippedPaths;
    }

    /**
     * {@inheritdoc}
     */
    public function accept(): bool
    {
        return !in_array(
            $this->current()->getFile(),
            $this->skippedPaths,
            true
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getSuite(): Suite
    {
        return $this->specificationIterator->getSuite();
    }
}
