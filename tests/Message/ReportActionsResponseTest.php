<?php

/*
 * This file is part of the recsys/advance.
 *
 * (c) JimChen <18219111672@163.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Recsys\Advance\Tests\Message;

use Recsys\Advance\Message\ReportActionsResponse;
use Recsys\Advance\Tests\TestCase;

class ReportActionsResponseTest extends TestCase
{
    use ResponseTestTrait;

    public function testGetCode()
    {
        $response = new ReportActionsResponse($this->request, [
            'code' => 200,
        ]);
        $this->assertSame(200, $response->getCode());

        $response = new ReportActionsResponse($this->request, [
            'code' => 1011,
        ]);
        $this->assertSame(1011, $response->getCode());

        $response = new ReportActionsResponse($this->request, [
        ]);
        $this->assertSame(200, $response->getCode());
    }

    public function testIsSuccessful()
    {
        $response = new ReportActionsResponse($this->request, [
            'code' => 200,
        ]);
        $this->assertTrue($response->isSuccessful());

        $response = new ReportActionsResponse($this->request, [
            'code' => 1011,
        ]);
        $this->assertFalse($response->isSuccessful());

        $response = new ReportActionsResponse($this->request, [
        ]);
        $this->assertTrue($response->isSuccessful());
    }

    public function testGetMessage()
    {
        $response = new ReportActionsResponse($this->request, [
            'code' => 200,
        ]);
        $this->assertNull($response->getMessage());

        $response = new ReportActionsResponse($this->request, [
            'code' => 1011,
            'info' => 'error',
        ]);
        $this->assertSame('error', $response->getMessage());
    }

    public function testGetStatuses()
    {
        $response = new ReportActionsResponse($this->request, [
            'statuses' => [
              [
                  'ActionLogStatusCode' => 0,
              ],
              [
                  'ActionLogStatusCode' => 0,
              ],
          ],
        ]);

        $this->assertSame([
            [
                'ActionLogStatusCode' => 0,
            ],
            [
                'ActionLogStatusCode' => 0,
            ],
        ], $response->getStatuses());
    }
}
