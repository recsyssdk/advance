<?php

/*
 * This file is part of the recsys/advance.
 *
 * (c) JimChen <18219111672@163.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Recsys\Advance\Tests\Model;

use Recsys\Advance\Model\BaseObject;
use Recsys\Advance\Tests\TestCase;

class BaseObjectTest extends TestCase
{
    public function testConstruct()
    {
        $object = new BaseObject([
            'foo' => 'bar',
        ]);

        $this->assertSame('bar', $object->foo);
    }

    public function testToArray()
    {
        $object = new BaseObject([
            'foo' => 'bar',
        ]);

        $this->assertSame([
            'foo' => 'bar',
        ], $object->toArray());
    }
}
