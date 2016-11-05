<?php

/*
 * This file is part of the SkipExtension package.
 *
 * (c) Kamil Kokot <kamil@kokot.me>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FriendsOfBehat\SkipExtension\Iterator;

final class SkipAwareFeatureIterator extends \FilterIterator
{
    /**
     * @var array
     */
    private $skipConfiguration;

    /**
     * @var string
     */
    private $basePath;

    /**
     * @param \Iterator $iterator
     * @param array $skipConfiguration
     * @param string $basePath
     */
    public function __construct(\Iterator $iterator, array $skipConfiguration, $basePath)
    {
        parent::__construct($iterator);

        $this->skipConfiguration = $skipConfiguration;
        $this->basePath = $basePath;
    }

    /**
     * {@inheritdoc}
     */
    public function accept()
    {
        $currentElementPath = $this->current()->getFile();

        return !in_array(
            str_replace($this->basePath.'/', '', $currentElementPath),
            $this->skipConfiguration
        );
    }
}
