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

namespace FriendsOfBehat\ExcludeSpecificationsExtension\ServiceContainer;

use Behat\Testwork\ServiceContainer\Extension;
use Behat\Testwork\ServiceContainer\ExtensionManager;
use FriendsOfBehat\ExcludeSpecificationsExtension\Locator\ExcludingSpecificationLocator;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

final class ExcludeSpecificationsExtension implements Extension
{
    /**
     * {@inheritdoc}
     */
    public function getConfigKey(): string
    {
        return 'fob_exclude_specifications';
    }

    /**
     * {@inheritdoc}
     */
    public function initialize(ExtensionManager $extensionManager): void
    {
    }

    /**
     * {@inheritdoc}
     */
    public function configure(ArrayNodeDefinition $builder): void
    {
        $builder
            ->children()
                ->arrayNode('features')
                    ->performNoDeepMerging()
                    ->prototype('scalar')->end()
                ->end()
            ->end()
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function load(ContainerBuilder $container, array $config): void
    {
        $definition = new Definition(ExcludingSpecificationLocator::class, [
            new Reference('specifications.locator.filesystem_feature.excluding.inner'),
            $this->getAbsoluteSkippedPaths($config['features'], $container->getParameter('paths.base'))
        ]);

        $definition->setDecoratedService('specifications.locator.filesystem_feature');
        $definition->setPublic(false);

        $container->setDefinition('specifications.locator.filesystem_feature.excluding', $definition);
    }

    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container): void
    {
    }

    /**
     * @param array $skippedPaths
     * @param string $basePath
     *
     * @return array
     */
    private function getAbsoluteSkippedPaths(array $skippedPaths, string $basePath): array
    {
        return array_map(function (string $skippedPath) use ($basePath): string {
            return $basePath . '/' . $skippedPath;
        }, $skippedPaths);
    }
}
