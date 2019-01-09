<?php

/*
 * This file is part of the recsys/advance.
 *
 * (c) JimChen <18219111672@163.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Recsys\Advance\Tests\Message;

use Recsys\Advance\Message\RemoveItemsRequest;
use Recsys\Advance\Tests\TestCase;

class RemoveItemsRequestTest extends TestCase
{
    protected function setUp()
    {
        $this->request = new RemoveItemsRequest($this->getHttpClient());
        $this->request->initialize([
            RemoveItemsRequest::KEY_NAME => [
                'foo', 'bar',
            ],
        ]);
    }

    public function testGetData()
    {
        $this->assertSame(['foo', 'bar'], $this->request->getData());
    }
}
