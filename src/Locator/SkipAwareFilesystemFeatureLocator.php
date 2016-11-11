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
use FriendsOfBehat\SkipExtension\Iterator\SkipAwareFeatureIterator;

/**
 * @author Mateusz Zalewski <mateusz.p.zalewski@gmail.com>
 */
class SkipAwareFilesystemFeatureLocator implements SpecificationLocator
{
    /**
     * @var SpecificationLocator
     */
    private $filesystemFeatureLocator;

    /**
     * @var array
     */
    private $skipConfiguration;

    /**
     * @var string
     */
    private $basePath;

    /**
     * @param SpecificationLocator $filesystemFeatureLocator
     * @param array $skipConfiguration
     * @param string $basePath
     */
    public function __construct(SpecificationLocator $filesystemFeatureLocator, array $skipConfiguration, $basePath)
    {
        $this->filesystemFeatureLocator = $filesystemFeatureLocator;
        $this->skipConfiguration = $skipConfiguration;
        $this->basePath = $basePath;
    }

    /**
     * {@inheritdoc}
     */
    public function getLocatorExamples()
    {
        return $this->filesystemFeatureLocator->getLocatorExamples();
    }

    /**
     * {@inheritdoc}
     */
    public function locateSpecifications(Suite $suite, $locator)
    {
        return new SkipAwareFeatureIterator(
            $this->filesystemFeatureLocator->locateSpecifications($suite, $locator),
            $this->skipConfiguration,
            $this->basePath
        );
    }
}
