<?php

/*
 * This file is part of the recsys/advance.
 *
 * (c) JimChen <18219111672@163.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Recsys\Advance\Tests\Message;

use Recsys\Advance\Message\FindItemRequest;
use Recsys\Advance\Message\FindItemResponse;
use Recsys\Advance\Tests\TestCase;

class FindItemRequestTest extends TestCase
{
    protected function setUp()
    {
        $this->request = new FindItemRequest($this->getHttpClient());
    }

    public function testResponse()
    {
        $response = $this->changeProtectedMethod($this->request, 'createResponse')->invoke($this->request, $this->request, []);
        $this->assertInstanceOf(FindItemResponse::class, $response);
    }
}
