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

/**
 * @internal
 */
final class SkipAwareFeatureIterator extends \FilterIterator
{
    /**
     * @var array
     */
    private $skippedPaths;

    /**
     * @param \Iterator $iterator
     * @param array $skippedPaths
     */
    public function __construct(\Iterator $iterator, array $skippedPaths)
    {
        parent::__construct($iterator);

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
}