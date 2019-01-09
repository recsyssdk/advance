<?php

/*
 * This file is part of the recsys/advance.
 *
 * (c) JimChen <18219111672@163.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Recsys\Advance\Message;

class RecommendResponse extends Response
{
    /**
     * Is the response successful?
     *
     * @return bool
     */
    public function isSuccessful()
    {
        return !array_key_exists('errmsg', $this->data);
    }

    public function getMessage()
    {
        if (!$this->isSuccessful()) {
            return $this->data['errmsg'];
        }

        return null;
    }

    public function getData()
    {
        return $this->data;
    }
}
