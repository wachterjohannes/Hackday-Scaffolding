<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Bridge\Doctrine\Tests\Fixtures;

/** @Entity */
class ItemGroupEntity
{
    /** @Id @Column(type="integer") */
    protected $id;

    /** @Column(type="string", nullable=true) */
    public $name;

    /** @Column(type="string", nullable=true) */
    public $groupName;

    public function __construct($id, $name, $groupName)
    {
        $this->id = $id;
        $this->name = $name;
        $this->groupName = $groupName;
    }
}
