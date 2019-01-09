<?php

/*
 * This file is part of the recsys/advance.
 *
 * (c) JimChen <18219111672@163.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Recsys\Advance\Tests\Message;

use Recsys\Advance\Message\Response;
use Recsys\Advance\Tests\TestCase;

class ResponseTest extends TestCase
{
    use ResponseTestTrait;

    public function testIsSuccessful()
    {
        $response = new Response($this->request, [
            'code' => 200,
        ]);

        $this->assertTrue($response->isSuccessful());

        $response = new Response($this->request, [
            'code' => 100,
        ]);

        $this->assertFalse($response->isSuccessful());
    }

    public function testGetMessage()
    {
        $response = new Response($this->request, [
            'info' => 'foo',
        ]);

        $this->assertSame('foo', $response->getMessage());
    }

    public function testGetData()
    {
        $response = new Response($this->request, [
            'data' => 'bar',
        ]);

        $this->assertSame('bar', $response->getData());
    }
}
