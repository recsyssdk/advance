<?php

/*
 * This file is part of the recsys/advance.
 *
 * (c) JimChen <18219111672@163.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Recsys\Advance\Tests\Message;

use Recsys\Advance\Message\RecommendResponse;
use Recsys\Advance\Tests\TestCase;

class RecommendResponseTest extends TestCase
{
    use ResponseTestTrait;

    public function testIsSuccessful()
    {
        $response = new RecommendResponse($this->request, [
        ]);

        $this->assertTrue($response->isSuccessful());

        $response = new RecommendResponse($this->request, [
            'errmsg' => 'error',
        ]);

        $this->assertFalse($response->isSuccessful());
    }

    public function testGetMessage()
    {
        $response = new RecommendResponse($this->request, [
            'errmsg' => 'error',
        ]);

        $this->assertSame('error', $response->getMessage());

        $response = new RecommendResponse($this->request, [
        ]);

        $this->assertNull($response->getMessage());
    }

    public function testGetData()
    {
        $response = new RecommendResponse($this->request, [
            'errmsg' => 'error',
        ]);

        $this->assertSame([
            'errmsg' => 'error',
        ], $response->getData());
    }
}
