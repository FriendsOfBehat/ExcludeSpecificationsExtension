<?php

/*
 * This file is part of the SkipExtension package.
 *
 * (c) Kamil Kokot <kamil@kokot.me>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FriendsOfBehat\SkipExtension\ServiceContainer;

use Behat\Testwork\ServiceContainer\Extension;
use Behat\Testwork\ServiceContainer\ExtensionManager;
use FriendsOfBehat\SkipExtension\Locator\SkipAwareFilesystemFeatureLocator;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

final class SkipExtension implements Extension
{
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
        $builder
            ->children()
                ->arrayNode('features')
                    ->performNoDeepMerging()
                    ->prototype('scalar')
            ->end()
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function load(ContainerBuilder $container, array $config)
    {
        $definition = new Definition(SkipAwareFilesystemFeatureLocator::class, [
            new Reference('specifications.locator.filesystem_feature.decorated'),
            $config['features'],
            '%paths.base%',
        ]);

        $definition->setDecoratedService(
            'specifications.locator.filesystem_feature',
            'specifications.locator.filesystem_feature.decorated'
        );

        $container->setDefinition('specifications.locator.filesystem_feature.decorating', $definition);
    }

    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
    }
}
