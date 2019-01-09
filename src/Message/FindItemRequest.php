<?php

/*
 * This file is part of the recsys/advance.
 *
 * (c) JimChen <18219111672@163.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Recsys\Advance\Message;

class FindItemRequest extends FindItemsRequest
{
    protected function createResponse($data)
    {
        return $this->response = new FindItemResponse($this, $data);
    }
}
