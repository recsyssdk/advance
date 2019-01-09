<?php

/*
 * This file is part of the recsys/advance.
 *
 * (c) JimChen <18219111672@163.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Recsys\Advance\Exception;

use Throwable;

class GatewayErrorException extends Exception
{
    /**
     * @var array
     */
    protected $raw;

    /**
     * GatewayErrorException constructor.
     *
     * @param string         $message
     * @param int            $code
     * @param array          $raw
     * @param Throwable|null $previous
     */
    public function __construct($message = '', $code = 0, array $raw = [], Throwable $previous = null)
    {
        $this->raw = $raw;
        parent::__construct($message, $code, $previous);
    }

    /**
     * @return array
     */
    public function getRaw()
    {
        return $this->raw;
    }
}
