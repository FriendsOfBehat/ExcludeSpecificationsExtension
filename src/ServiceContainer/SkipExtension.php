<?php

/*
 * This file is part of the SkipExtension package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SkipExtension\ServiceContainer;

use Behat\Testwork\ServiceContainer\Extension;
use Behat\Testwork\ServiceContainer\ExtensionManager;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * @author Mateusz Zalewski <mateusz.p.zalewski@gmail.com>
 */
class SkipExtension implements Extension
{
    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {

    }

    /**
     * {@inheritdoc}
     */
    public function getConfigKey()
    {
        return 'skip';
    }

    /**
     * {@inheritdoc}
     */
    public function initialize(ExtensionManager $extensionManager)
    {

    }

    /**
     * {@inheritdoc}
     */
    public function configure(ArrayNodeDefinition $builder)
    {

    }

    /**
     * {@inheritdoc}
     */
    public function load(ContainerBuilder $container, array $config)
    {

    }
}
