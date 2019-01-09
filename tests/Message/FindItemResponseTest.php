<?php

/*
 * This file is part of the recsys/advance.
 *
 * (c) JimChen <18219111672@163.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Recsys\Advance\Tests\Message;

use Recsys\Advance\Message\FindItemResponse;
use Recsys\Advance\Tests\TestCase;

class FindItemResponseTest extends TestCase
{
    use ResponseTestTrait;

    public function testGetData()
    {
        $response = new FindItemResponse($this->request, [
            'data' => [
                [
                    'foo' => 'bar',
                ],
            ],
        ]);

        $this->assertSame([
            'foo' => 'bar',
        ], $response->getData());
    }
}
