<?php

/*
 * This file is part of the SkipExtension package.
 *
 * (c) Kamil Kokot <kamil@kokot.me>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FriendsOfBehat\SkipExtension\Locator;

use Behat\Testwork\Specification\SpecificationIterator;

/**
 * @internal
 */
final class SkipAwareSpecificationIterator extends \FilterIterator implements SpecificationIterator
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
    public function accept()
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
    public function getSuite()
    {
        return $this->specificationIterator->getSuite();
    }
}
