<?php

/*
 * This file is part of the recsys/advance.
 *
 * (c) JimChen <18219111672@163.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Recsys\Advance\Tests\Message;

use Recsys\Advance\Message\ReportItemsRequest;
use Recsys\Advance\Tests\TestCase;
use Recsys\Common\Exception\InvalidRequestException;

class ReportItemsRequestTest extends TestCase
{
    protected function setUp()
    {
        $this->request = new ReportItemsRequest($this->getHttpClient());
        $this->request->initialize([
            ReportItemsRequest::KEY_NAME => [
                [
                    'itemId' => '1',
                    'title' => 'xxxx',
                    'content' => 'xxxx',
                    'url' => 'xxxx',
                ],
                [
                    'itemId' => '2',
                    'title' => 'xxxx',
                    'content' => 'xxxx',
                    'url' => 'xxxx',
                ],
            ],
        ]);
    }

    public function testGetData()
    {
        $this->assertSame([
            [
                'itemId' => '1',
                'title' => 'xxxx',
                'content' => 'xxxx',
                'url' => 'xxxx',
            ],
            [
                'itemId' => '2',
                'title' => 'xxxx',
                'content' => 'xxxx',
                'url' => 'xxxx',
            ],
        ], $this->request->getData());
    }

    public function testGetDataWithoutRequiredParameter()
    {
        $this->request->initialize([
            ReportItemsRequest::KEY_NAME => [
                [
                    'itemId' => '1',
                    'title' => 'xxxx',
                    'content' => 'xxxx',
                    'url' => 'xxxx',
                ],
                [
                    'itemId' => '2',
                    'title' => 'xxxx',
                    'content' => 'xxxx',
                ],
            ],
        ]);

        $this->setExpectedException(InvalidRequestException::class, "The 'url' parameter is required, item key: 1");

        $this->request->getData();
    }
}
