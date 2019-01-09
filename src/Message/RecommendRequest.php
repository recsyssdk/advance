<?php

/*
 * This file is part of the recsys/advance.
 *
 * (c) JimChen <18219111672@163.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Recsys\Advance\Message;

use JimChen\Utils\Arr;
use Recsys\Advance\Exception\InvalidResponseException;
use Recsys\Common\Message\ResponseInterface;

class RecommendRequest extends AbstractRequest
{
    const ENDPOINT = 'https://nbrecsys.4paradigm.com/api/v0/recom/recall';

    /**
     * Get the raw data array for this message. The format of this varies from gateway to
     * gateway, but will usually be either an associative array, or a SimpleXMLElement.
     *
     * @return mixed
     */
    public function getData()
    {
        $this->validate('requestID', 'sceneID', 'userID');

        $data = [
            'requestID' => $this->getParameter('requestID'),
            'sceneID' => $this->getParameter('sceneID'),
            'userID' => $this->getParameter('userID'),
            'itemID' => $this->getParameter('itemID'),
            'itemTitle' => $this->getParameter('itemTitle'),
            'page' => (int) $this->getParameter('page'),
        ];

        return array_filter($data);
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
            $contents = $this->httpPostJson(self::ENDPOINT,
                Arr::only($data, ['itemID', 'itemTitle', 'page']),
                [
                    'query' => Arr::only($data, ['requestID', 'sceneID', 'userID']),
                ]);

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
        return $this->response = new RecommendResponse($this, $data);
    }
}
