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
use Recsys\Common\Exception\InvalidRequestException;
use Recsys\Common\Message\ResponseInterface;

class RemoveItemsRequest extends AbstractRequest
{
    const ENDPOINT = 'https://nbrecsys.4paradigm.com/business/items/remove';

    const KEY_NAME = 'itemIds';

    /**
     * Get the raw data array for this message. The format of this varies from gateway to
     * gateway, but will usually be either an associative array, or a SimpleXMLElement.
     *
     * @return array
     */
    public function getData()
    {
        $itemIds = (array) $this->getParameter(self::KEY_NAME);
        if (empty($itemIds)) {
            throw new InvalidRequestException('The deleteItemIds parameter is required');
        }

        return $itemIds;
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
            $contents = $this->httpPostJson(self::ENDPOINT, $data, [
                'query' => [
                    'type' => 1,
                ],
            ]);

            return $this->createResponse($contents);
        } catch (\Exception $e) {
            throw new InvalidResponseException(
                'Error communicating with recsys gateway: '.$e->getMessage(),
                $e->getCode()
            );
        }
    }
}
