<?php

/*
 * This file is part of the recsys/advance.
 *
 * (c) JimChen <18219111672@163.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Recsys\Advance\Message;

class ReportActionsResponse extends Response
{
    public function getCode()
    {
        if (array_key_exists('code', $this->data)) {
            return $this->data['code'];
        }

        return self::SUCCESS_CODE;
    }

    public function getMessage()
    {
        if (!$this->isSuccessful()) {
            return parent::getMessage();
        }

        return null;
    }

    public function getData()
    {
        return $this->getStatuses();
    }

    public function getStatuses()
    {
        if ($this->isSuccessful()) {
            return $this->data['statuses'];
        }

        return null;
    }
}
