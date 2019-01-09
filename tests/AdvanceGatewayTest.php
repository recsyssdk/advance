<?php

/*
 * This file is part of the recsys/advance.
 *
 * (c) JimChen <18219111672@163.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Recsys\Advance\Tests;

use Recsys\Advance\AdvanceGateway;

class AdvanceGatewayTest extends TestCase
{
    public function testSetClientToken()
    {
        $gateway = new AdvanceGateway();
        $gateway->setClientToken('foo');

        $this->assertSame('foo', $gateway->getClientToken());
    }

    public function testSetAccessToken()
    {
        $gateway = new AdvanceGateway();
        $gateway->setAccessToken('bar');

        $this->assertSame('bar', $gateway->getAccessToken());
    }
}
