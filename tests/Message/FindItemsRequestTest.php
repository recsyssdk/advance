<?php

/*
 * This file is part of the recsys/advance.
 *
 * (c) JimChen <18219111672@163.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Recsys\Advance\Tests\Message;

use Recsys\Advance\Message\FindItemsRequest;
use Recsys\Advance\Tests\TestCase;

class FindItemsRequestTest extends TestCase
{
    protected $request;

    protected function setUp()
    {
        $this->request = new FindItemsRequest($this->getHttpClient());
        $this->request->initialize([
            FindItemsRequest::KEY_NAME => [
                'foo' => 'bar',
            ],
        ]);
    }

    public function testGetData()
    {
        $this->assertSame([
            'foo' => 'bar',
        ], $this->request->getData());
    }
}
