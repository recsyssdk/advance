<?php

/*
 * This file is part of the recsys/advance.
 *
 * (c) JimChen <18219111672@163.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Recsys\Advance\Message;

class FindItemResponse extends Response
{
    public function getData()
    {
        $data = parent::getData();
        if (is_array($data) && count($data) > 0) {
            return array_shift($data);
        }

        return null;
    }
}
