<?php

/*
 * This file is part of the recsys/advance.
 *
 * (c) JimChen <18219111672@163.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Recsys\Advance;

use JimChen\Utils\Arr;
use Recsys\Advance\Message\FindItemRequest;
use Recsys\Advance\Message\FindItemsRequest;
use Recsys\Advance\Message\RecommendRequest;
use Recsys\Advance\Message\RemoveItemsRequest;
use Recsys\Advance\Message\ReportActionsRequest;
use Recsys\Advance\Message\ReportItemsRequest;
use Recsys\Common\AbstractGateway;

class AdvanceGateway extends AbstractGateway
{
    /**
     * Set client token.
     *
     * @param $value
     *
     * @return AdvanceGateway
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
     * @return AdvanceGateway
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

    public function reportItems(array $parameters)
    {
        return $this->createRequest(ReportItemsRequest::class, [
            ReportItemsRequest::KEY_NAME => $parameters,
        ])->noRequiredClientToken();
    }

    public function reportItem(array $parameter)
    {
        return $this->reportItems([$parameter]);
    }

    public function removeItems(array $itemIds)
    {
        return $this->createRequest(RemoveItemsRequest::class, [
            RemoveItemsRequest::KEY_NAME => $itemIds,
        ])->noRequiredClientToken();
    }

    public function removeItem($itemId)
    {
        return $this->removeItems([$itemId]);
    }

    public function findItems(array $itemIds)
    {
        return $this->createRequest(FindItemsRequest::class, [
            FindItemsRequest::KEY_NAME => $itemIds,
        ])->noRequiredClientToken();
    }

    public function findItem($itemId)
    {
        return $this->createRequest(FindItemRequest::class, [
            FindItemRequest::KEY_NAME => [$itemId],
        ])->noRequiredClientToken();
    }

    public function reportActions(array $parameters)
    {
        // datetime
        $_parameters[ReportActionsRequest::KEY_DATE] = Arr::has($parameters, ReportActionsRequest::KEY_DATE) ?
            $parameters[ReportActionsRequest::KEY_DATE] : date('Y-m-d H:i:s');
        // user action
        $_parameters[ReportActionsRequest::KEY_ACTIONS] = Arr::has($parameters, ReportActionsRequest::KEY_ACTIONS) ?
            $parameters[ReportActionsRequest::KEY_ACTIONS] : $parameters;

        return $this->createRequest(ReportActionsRequest::class, $_parameters)->noRequiredAccessToken();
    }

    public function reportAction($parameter)
    {
        if (Arr::has($parameter, ReportActionsRequest::KEY_DATE)) {
            $_parameters[ReportActionsRequest::KEY_DATE] = $parameter[ReportActionsRequest::KEY_DATE];
            unset($parameter[ReportActionsRequest::KEY_DATE]);
        }

        if (Arr::has($parameter, ReportActionsRequest::KEY_ACTIONS)) {
            $_parameters[ReportActionsRequest::KEY_ACTIONS] = [$parameter[ReportActionsRequest::KEY_ACTIONS]];
        } else {
            $_parameters[ReportActionsRequest::KEY_ACTIONS] = [$parameter];
        }

        return $this->reportActions($_parameters);
    }

    public function recommend(array $parameters)
    {
        return $this->createRequest(RecommendRequest::class, $parameters)->noRequiredToken();
    }
}
