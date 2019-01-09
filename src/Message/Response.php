<?php

/*
 * This file is part of the recsys/advance.
 *
 * (c) JimChen <18219111672@163.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Recsys\Advance\Message;

use Recsys\Common\Message\AbstractResponse;

class Response extends AbstractResponse
{
    const SUCCESS_CODE = 200;

    /**
     * Is the response successful?
     *
     * @return boolean
     */
    public function isSuccessful()
    {
        return self::SUCCESS_CODE === $this->getCode();
    }

    public function getCode()
    {
        return $this->data['code'];
    }

    public function getData()
    {
        return $this->data['data'];
    }

    public function getMessage()
    {
        return $this->data['info'];
    }
}
