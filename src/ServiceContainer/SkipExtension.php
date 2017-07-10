<?php

declare(strict_types=1);

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
    public function getConfigKey(): string
    {
        return 'fob_skip';
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
        $definition = new Definition(SkipAwareSpecificationLocator::class, [
            new Reference('specifications.locator.filesystem_feature.skip_aware.inner'),
            $this->getAbsoluteSkippedPaths($config['features'], $container->getParameter('paths.base'))
        ]);

        $definition->setDecoratedService('specifications.locator.filesystem_feature');
        $definition->setPublic(false);

        $container->setDefinition('specifications.locator.filesystem_feature.skip_aware', $definition);
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
