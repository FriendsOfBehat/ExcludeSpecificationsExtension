<?php

/*
 * This file is part of the SkipExtension package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SkipExtension\Tester;

use Behat\Testwork\Environment\Environment;
use Behat\Testwork\Tester\Result\TestResult;
use Behat\Testwork\Tester\SpecificationTester;

/**
 * @author Mateusz Zalewski <mateusz.p.zalewski@gmail.com>
 */
class SkipAwareHookableFeatureTester implements SpecificationTester
{
    /**
     * @var SpecificationTester
     */
    private $baseTester;

    /**
     * @var array
     */
    private $skipConfiguration;

    /**
     * @param SpecificationTester $baseTester
     * @param array $skipConfiguration
     */
    public function __construct(SpecificationTester $baseTester, array $skipConfiguration)
    {
        $this->baseTester = $baseTester;
        $this->skipConfiguration = $skipConfiguration;
    }

    /**
     * {@inheritdoc}
     */
    public function setUp(Environment $env, $spec, $skip)
    {
        return $this->baseTester->setUp($env, $spec, $skip);
    }

    /**
     * {@inheritdoc}
     */
    public function test(Environment $env, $spec, $skip)
    {
        if ($this->shouldFeatureBeSkipped($spec->getFile())) {
            $skip = true;
        }

        return $this->baseTester->test($env, $spec, $skip);
    }

    /**
     * {@inheritdoc}
     */
    public function tearDown(Environment $env, $spec, $skip, TestResult $result)
    {
        return $this->baseTester->tearDown($env, $spec, $skip, $result);
    }

    /**
     * @param string $featurePath
     *
     * @return bool
     */
    private function shouldFeatureBeSkipped($featurePath)
    {
        foreach ($this->skipConfiguration['features'] as $featureToSkip) {
            if (false !== strpos($featurePath, $featureToSkip)) {
                return true;
            }
        }

        return false;
    }
}
