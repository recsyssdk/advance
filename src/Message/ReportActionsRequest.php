<?php

/*
 * This file is part of the recsys/advance.
 *
 * (c) JimChen <18219111672@163.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Recsys\Advance\Message;

use Recsys\Advance\Exception\InvalidResponseException;
use Recsys\Advance\Model\BaseObject;
use Recsys\Common\Message\ResponseInterface;

class ReportActionsRequest extends AbstractRequest
{
    const ENDPOINT = 'https://nbrecsys.4paradigm.com/action/api/log';

    const KEY_DATE = 'date';

    const KEY_ACTIONS = 'actions';

    /**
     * Get the raw data array for this message. The format of this varies from gateway to
     * gateway, but will usually be either an associative array, or a SimpleXMLElement.
     *
     * @return mixed
     */
    public function getData()
    {
        $this->validate(self::KEY_DATE, self::KEY_ACTIONS);
        $actions = $this->getActions();
        $data[self::KEY_DATE] = $this->getDate();

        $object = new BaseObject();
        foreach ($actions as $key => $action) {
            $object->initialize($action)->setItemKey($key);
            $object->validate('itemId', 'actionTime', 'action', 'itemSetId', 'sceneId', 'userId');
            $data[self::KEY_ACTIONS][] = $object->toArray();
        }

        return $data;
    }

    /**
     * Send the request with specified data.
     *
     * @param mixed $data The data to send
     *
     * @return ResponseInterface
     */
    public function sendData($data)
    {
        try {
            $contents = $this->httpPostJson(self::ENDPOINT, $data);

            return $this->createResponse($contents);
        } catch (\Exception $e) {
            throw new InvalidResponseException(
                'Error communicating with recsys gateway: '.$e->getMessage(),
                $e->getCode()
            );
        }
    }

    protected function createResponse($data)
    {
        return $this->response = new ReportActionsResponse($this, $data);
    }

    public function getDate()
    {
        return $this->getParameter(self::KEY_DATE);
    }

    public function setDate($value)
    {
        return $this->setParameter(self::KEY_DATE, $value);
    }

    public function getActions()
    {
        return $this->getParameter(self::KEY_ACTIONS);
    }

    public function setActions($value)
    {
        return $this->setParameter(self::KEY_ACTIONS, $value);
    }

    public function addAction($value)
    {
        $actions = $this->getActions();
        array_push($actions, $value);

        return $this->setParameter(self::KEY_ACTIONS, $actions);
    }
}
