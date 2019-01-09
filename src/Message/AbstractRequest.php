<?php

/*
 * This file is part of the recsys/advance.
 *
 * (c) JimChen <18219111672@163.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Recsys\Advance\Message;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;

abstract class AbstractRequest extends \Recsys\Common\Message\AbstractRequest
{
    protected $isNeedClientToken = true;

    protected $isNeedAccessToken = true;

    /**
     * Set no required client token.
     *
     * @return $this
     */
    public function noRequiredClientToken()
    {
        $this->isNeedClientToken = false;

        return $this;
    }

    /**
     * Set no required access token.
     *
     * @return $this
     */
    public function noRequiredAccessToken()
    {
        $this->isNeedAccessToken = false;

        return $this;
    }

    /**
     * Set no required all token.
     *
     * @return $this
     */
    public function noRequiredToken()
    {
        return $this->noRequiredAccessToken()->noRequiredClientToken();
    }

    /**
     * Set client token.
     *
     * @param string $value
     *
     * @return $this
     */
    public function setClientToken($value)
    {
        return $this->setParameter('clientToken', $value);
    }

    /**
     * Get client token.
     *
     * @return mixed
     */
    public function getClientToken()
    {
        return $this->getParameter('clientToken');
    }

    /**
     * Set access token.
     *
     * @param $value
     *
     * @return $this
     */
    public function setAccessToken($value)
    {
        return $this->setParameter('accessToken', $value);
    }

    /**
     * Get access token.
     *
     * @return mixed
     */
    public function getAccessToken()
    {
        return $this->getParameter('accessToken');
    }

    /**
     * Make a get request.
     *
     * @param string|UriInterface $uri
     * @param array               $data
     * @param array               $options
     *
     * @return string|array
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function httpGet($uri, $data, $options = [])
    {
        $options['query'] = $data;

        return $this->httpRequest('GET', $uri, $options);
    }

    /**
     * Make a post request with json params.
     *
     * @param string|UriInterface $uri
     * @param array               $data
     * @param array               $options
     *
     * @return string|array
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function httpPostJson($uri, $data, $options = [])
    {
        $options['json'] = $data;

        return $this->httpRequest('POST', $uri, $options);
    }

    /**
     * Make a request.
     *
     * @param string|UriInterface $uri
     * @param array               $data
     * @param array               $options
     *
     * @return mixed|string
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function httpRequest($method, $uri, $options = [])
    {
        $authorize = $this->getAuthorize();
        if (array_key_exists('query', $options)) {
            $options['query'] = array_merge($options['query'], array_filter($authorize));
        } else {
            $options['query'] = array_filter($authorize);
        }

        return $this->unwrapResponse($this->httpClient->request($method, $uri, $options));
    }

    protected function getAuthorize()
    {
        return [
            'accessToken' => $this->isNeedAccessToken ? $this->getAccessToken() : null,
            'clientToken' => $this->isNeedClientToken ? $this->getClientToken() : null,
        ];
    }

    protected function unwrapResponse(ResponseInterface $response)
    {
        $contentType = $response->getHeaderLine('Content-Type');
        $contents = $response->getBody()->getContents();
        if (false !== stripos($contentType, 'json') || stripos($contentType, 'javascript')) {
            return json_decode($contents, true);
        } elseif (false !== stripos($contentType, 'xml')) {
            return json_decode(json_encode(simplexml_load_string($contents)), true);
        }

        return $contents;
    }

    protected function createResponse($data)
    {
        return $this->response = new Response($this, $data);
    }
}
