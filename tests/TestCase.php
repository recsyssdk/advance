<?php

/*
 * This file is part of the recsys/advance.
 *
 * (c) JimChen <18219111672@163.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Recsys\Advance\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Recsys\Advance\Message\AbstractRequest;
use ReflectionMethod;

class TestCase extends \PHPUnit\Framework\TestCase
{
    /** @var AbstractRequest */
    protected $request;

    /**
     * @return ClientInterface
     */
    public function getHttpClient()
    {
        return new Client();
    }

    /**
     * @param $object
     * @param $method
     *
     * @return ReflectionMethod
     */
    public function changeProtectedMethod($object, $method)
    {
        $method = new ReflectionMethod($object, $method);
        $method->setAccessible(true);

        return $method;
    }
}
