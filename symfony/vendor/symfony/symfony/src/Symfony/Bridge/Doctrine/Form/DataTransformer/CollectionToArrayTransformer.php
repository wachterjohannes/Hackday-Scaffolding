<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Bridge\Doctrine\Form\DataTransformer;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

/**
 * @author Bernhard Schussek <bschussek@gmail.com>
 */
class CollectionToArrayTransformer implements DataTransformerInterface
{
    /**
     * Transforms a collection into an array.
     *
     * @param Collection $collection A collection of entities
     *
     * @return mixed An array of entities
     *
     * @throws TransformationFailedException
     */
    public function transform($collection)
    {
        if (null === $collection) {
            return array();
        }

        if (!$collection instanceof Collection) {
            throw new TransformationFailedException('Expected a Doctrine\Common\Collections\Collection object.');
        }

        return $collection->toArray();
    }

    /**
     * Transforms choice keys into entities.
     *
     * @param mixed $array An array of entities
     *
     * @return Collection   A collection of entities
     */
    public function reverseTransform($array)
    {
        if ('' === $array || null === $array) {
            $array = array();
        } else {
            $array = (array)$array;
        }

        return new ArrayCollection($array);
    }
}
