<?php

/*
 * This file is part of the recsys/advance.
 *
 * (c) JimChen <18219111672@163.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Recsys\Advance\Tests\Message;

use Recsys\Advance\Message\ReportActionsRequest;
use Recsys\Advance\Tests\TestCase;
use Recsys\Common\Exception\InvalidRequestException;

class ReportActionsRequestTest extends TestCase
{
    protected function setUp()
    {
        $this->request = new ReportActionsRequest($this->getHttpClient());
        $this->request->initialize([
            ReportActionsRequest::KEY_DATE => '2019-01-09 15:35:00',
            ReportActionsRequest::KEY_ACTIONS => [
                [
                    'itemId' => '1111',
                    'actionTime' => '12345678',
                    'action' => 'show',
                    'itemSetId' => '222',
                    'sceneId' => '444',
                    'userId' => 'JimChen007',
                ],
            ],
        ]);
    }

    public function testGetData()
    {
        $this->assertSame([
            ReportActionsRequest::KEY_DATE => '2019-01-09 15:35:00',
            ReportActionsRequest::KEY_ACTIONS => [
                [
                    'itemId' => '1111',
                    'actionTime' => '12345678',
                    'action' => 'show',
                    'itemSetId' => '222',
                    'sceneId' => '444',
                    'userId' => 'JimChen007',
                ],
            ],
        ], $this->request->getData());
    }

    public function testGetDataWithoutRequiredParameter()
    {
        $this->request->initialize([
            ReportActionsRequest::KEY_DATE => '2019-01-09 15:35:00',
            ReportActionsRequest::KEY_ACTIONS => [
                [
                    'itemId' => '1111',
                    'actionTime' => '12345678',
                    'action' => 'show',
                    'itemSetId' => '222',
                    'userId' => 'JimChen007',
                ],
            ],
        ]);

        $this->setExpectedException(InvalidRequestException::class, "The 'sceneId' parameter is required, item key: 0");

        $this->request->getData();
    }
}
