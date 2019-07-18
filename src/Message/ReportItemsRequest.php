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

/**
 * Class ReportObjectsRequest.
 *
 * @property string itemId
 * @property string title
 * @property string content
 * @property string url
 * @property string categoryId
 * @property string publishTime
 * @property string publisherId
 * @property string isRecommend
 * @property string tag
 * @property string coverUrl
 * @property string location
 */
class ReportItemsRequest extends AbstractRequest
{
    const ENDPOINT = 'https://nbrecsys.4paradigm.com/business/items';

    /**
     * Item key name.
     */
    const KEY_NAME = 'items';

    /**
     * Get the raw data array for this message. The format of this varies from gateway to
     * gateway, but will usually be either an associative array, or a SimpleXMLElement.
     *
     * @return mixed
     */
    public function getData()
    {
        $items = $this->getItems();
        $data = [];
        $object = new BaseObject();
        foreach ($items as $key => $item) {
            $object->initialize($item)->setItemKey($key);
            $object->validate('itemId', 'title', 'content', 'url');
            $data[] = array_filter($object->toArray(), function ($value) {
                if (is_string($value) && $value !== '0') {
                    return !empty($value);
                }
                return true;
            });
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

    /**
     * @return array
     */
    protected function getItems()
    {
        return (array) $this->getParameter(self::KEY_NAME);
    }
}
