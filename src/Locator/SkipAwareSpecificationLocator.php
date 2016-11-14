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

use Behat\Testwork\Specification\Locator\SpecificationLocator;
use Behat\Testwork\Suite\Suite;

/**
 * @internal
 */
final class SkipAwareSpecificationLocator implements SpecificationLocator
{
    /**
     * @var SpecificationLocator
     */
    private $specificationLocator;

    /**
     * @var array
     */
    private $skippedPaths;

    /**
     * @param SpecificationLocator $filesystemFeatureLocator
     * @param array $skippedPaths
     */
    public function __construct(SpecificationLocator $filesystemFeatureLocator, array $skippedPaths)
    {
        $this->specificationLocator = $filesystemFeatureLocator;
        $this->skippedPaths = $skippedPaths;
    }

    /**
     * {@inheritdoc}
     */
    public function getLocatorExamples()
    {
        return $this->specificationLocator->getLocatorExamples();
    }

    /**
     * {@inheritdoc}
     */
    public function locateSpecifications(Suite $suite, $locator)
    {
        return new SkipAwareSpecificationIterator(
            $this->specificationLocator->locateSpecifications($suite, $locator),
            $this->skippedPaths
        );
    }
}
