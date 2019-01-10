<?php

/*
 * This file is part of the recsys/advance.
 *
 * (c) JimChen <18219111672@163.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Recsys\Advance\Tests\Message;

use Recsys\Advance\Message\RecommendRequest;
use Recsys\Advance\Tests\TestCase;
use Recsys\Common\Exception\InvalidRequestException;

class RecommendRequestTest extends TestCase
{
    public function setUp()
    {
        $this->request = new RecommendRequest($this->getHttpClient());
        $this->request->initialize([
            'requestID' => (string) time(),
            'sceneID' => '4444',
            'userID' => 'JimChen007',
            'itemID' => 'qusvnrfda',
            'itemTitle' => 'Hello World',
            'page' => 1,
        ]);
    }

    public function testGetData()
    {
        $this->assertSame([
            'requestID' => (string) time(),
            'sceneID' => '4444',
            'userID' => 'JimChen007',
            'itemID' => 'qusvnrfda',
            'itemTitle' => 'Hello World',
            'page' => 1,
        ], $this->request->getData());
    }

    public function testGetDataWithoutRequiredParameters()
    {
        $this->request->initialize([
            'sceneID' => '4444',
            'userID' => 'JimChen007',
            'itemID' => 'qusvnrfda',
            'itemTitle' => 'Hello World',
            'page' => 1,
        ]);
        $this->setExpectedException(InvalidRequestException::class, "The 'requestID' parameter is required");
        $this->request->getData();

        $this->request->initialize([
            'requestID' => (string) time(),
            'userID' => 'JimChen007',
            'itemID' => 'qusvnrfda',
            'itemTitle' => 'Hello World',
            'page' => 1,
        ]);
        $this->setExpectedException(InvalidRequestException::class, "The 'sceneID' parameter is required");
        $this->request->getData();

        $this->request->initialize([
            'requestID' => (string) time(),
            'sceneID' => '4444',
            'itemID' => 'qusvnrfda',
            'itemTitle' => 'Hello World',
            'page' => 1,
        ]);
        $this->setExpectedException(InvalidRequestException::class, "The 'userID' parameter is required");
        $this->request->getData();
    }
    public function testFilterPage()
    {
        $this->request->initialize([
            'requestID' => (string) time(),
            'sceneID' => '4444',
            'userID' => 'JimChen007',
            'page' => 0,
        ]);

        $this->assertArrayHasKey('page', $this->request->getData());
        $this->assertSame(0, $this->request->getData()['page']);

        $this->request->initialize([
            'requestID' => (string) time(),
            'sceneID' => '4444',
            'userID' => 'JimChen007',
            'page' => '0',
        ]);

        $this->assertArrayHasKey('page', $this->request->getData());
        $this->assertSame(0, $this->request->getData()['page']);

        $this->request->initialize([
            'requestID' => (string) time(),
            'sceneID' => '4444',
            'userID' => 'JimChen007',
            'page' => -1,
        ]);
        $this->assertArrayNotHasKey('page', $this->request->getData());
    }
}
