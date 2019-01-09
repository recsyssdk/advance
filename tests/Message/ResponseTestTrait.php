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

trait ResponseTestTrait
{
    protected function setUp()
    {
        $this->request = m::mock('\Recsys\Advance\Message\AbstractRequest')->makePartial();
    }
}
