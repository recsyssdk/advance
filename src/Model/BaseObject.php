<?php

/*
 * This file is part of the recsys/advance.
 *
 * (c) JimChen <18219111672@163.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Recsys\Advance\Model;

use Recsys\Common\Exception\InvalidRequestException;
use Recsys\Common\ParametersTrait;

class BaseObject
{
    protected $itemKey;

    use ParametersTrait {
        validate as traitValidate;
    }

    public function __construct(array $parameters = [])
    {
        $this->initialize($parameters);
    }

    public function toArray()
    {
        return $this->getParameters();
    }

    public function __get($parameter)
    {
        return $this->getParameter($parameter);
    }

    public function setItemKey($key)
    {
        $this->itemKey = $key;

        return $this;
    }

    public function validate()
    {
        try {
            call_user_func_array([$this, 'traitValidate'], func_get_args());
        } catch (InvalidRequestException $e) {
            if (null !== $this->itemKey) {
                throw new InvalidRequestException($e->getMessage().", item key: {$this->itemKey} ");
            }

            throw $e;
        }
    }
}
