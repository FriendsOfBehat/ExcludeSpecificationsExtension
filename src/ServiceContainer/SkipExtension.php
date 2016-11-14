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
use FriendsOfBehat\SkipExtension\Locator\SkipAwareSpecificationLocator;
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
        $definition = new Definition(SkipAwareSpecificationLocator::class, [
            new Reference('specifications.locator.filesystem_feature.inner'),
            $this->getAbsoluteSkippedPaths($config, $container->getParameter('paths.base'))
        ]);

        $definition->setDecoratedService(
            'specifications.locator.filesystem_feature',
            'specifications.locator.filesystem_feature.inner'
        );

        $container->setDefinition('specifications.locator.filesystem_feature.skip_aware', $definition);
    }

    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
    }

    /**
     * @param array $config
     * @param string $basePath
     *
     * @return array
     */
    private function getAbsoluteSkippedPaths(array $config, $basePath)
    {
        $skippedPaths = $config['features'];
        foreach ($skippedPaths as $key => $skippedPath) {
            $skippedPaths[$key] = $basePath.'/'.$skippedPath;
        }

        return $skippedPaths;
    }
}
