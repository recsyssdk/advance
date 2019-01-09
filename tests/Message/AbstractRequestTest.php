<?php

/*
 * This file is part of the recsys/advance.
 *
 * (c) JimChen <18219111672@163.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Recsys\Advance\Tests\Message;

use Mockery as m;
use Recsys\Advance\Message\AbstractRequest;
use Recsys\Advance\Tests\TestCase;

class AbstractRequestTest extends TestCase
{
    /** @var AbstractRequest */
    protected $request;

    public function setUp()
    {
        $this->request = m::mock('\Recsys\Advance\Message\AbstractRequest')->makePartial();
        $this->request->initialize();
    }

    public function testSetClientToken()
    {
        $this->request->setClientToken('foo');
        $this->assertSame('foo', $this->request->getClientToken());

        $authorize = $this->changeProtectedMethod($this->request, 'getAuthorize')->invoke($this->request);
        $this->assertSame('foo', $authorize['clientToken']);
    }

    public function testSetAccessToken()
    {
        $this->request->setAccessToken('bar');
        $this->assertSame('bar', $this->request->getAccessToken());

        $authorize = $this->changeProtectedMethod($this->request, 'getAuthorize')->invoke($this->request);
        $this->assertSame('bar', $authorize['accessToken']);
    }

    public function testGetAuthorize()
    {
        $this->request->setClientToken('foo');
        $this->request->setAccessToken('bar');
        $authorize = $this->changeProtectedMethod($this->request, 'getAuthorize')->invoke($this->request);

        $this->assertSame([
            'accessToken' => 'bar',
            'clientToken' => 'foo',
        ], $authorize);
    }

    public function testIfNoRequiredClientToken()
    {
        $this->request->setClientToken('foo')->noRequiredClientToken();
        $authorize = $this->changeProtectedMethod($this->request, 'getAuthorize')->invoke($this->request);

        $this->assertNull($authorize['clientToken']);
    }

    public function testIfNoRequiredAccessToken()
    {
        $this->request->setAccessToken('foo')->noRequiredAccessToken();
        $authorize = $this->changeProtectedMethod($this->request, 'getAuthorize')->invoke($this->request);

        $this->assertNull($authorize['accessToken']);
    }

    public function testIfNoRequiredToken()
    {
        $this->request
            ->setClientToken('bar')
            ->setAccessToken('foo')
            ->noRequiredToken();
        $authorize = $this->changeProtectedMethod($this->request, 'getAuthorize')->invoke($this->request);

        $this->assertNull($authorize['accessToken']);
        $this->assertNull($authorize['clientToken']);
    }
}
