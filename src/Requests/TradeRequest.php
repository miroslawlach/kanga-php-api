<?php

namespace MiroslawLach\KangaPHPAPI\Requests;

use MiroslawLach\KangaPHPAPI\Exceptions\NotImplementedException;
use MiroslawLach\KangaPHPAPI\Types\Type;

class TradeRequest
{
    /**
     * Returns the list of all markets. This call will be deprecated in the near future.
     *
     * @throws NotImplementedException
     */
    public function markets()
    {
        throw new NotImplementedException();
    }

    /**
     * Returns the order book for the specified market (cached every 2 seconds).
     *
     * @throws NotImplementedException
     */
    public function orderBook(string $market)
    {
        throw new NotImplementedException();
    }

    /**
     * Cancels the order identified by orderId.
     *
     * @throws NotImplementedException
     */
    public function orderCancel(string $orderId)
    {
        throw new NotImplementedException();
    }

    /**
     * @throws NotImplementedException
     */
    public function orderCreate(string $quantity, Type $type, string $market, ?string $price = null, ?string $valueLimit = null)
    {
        throw new NotImplementedException();
    }

    /**
     * Returns the details of the specified order.
     *
     * @throws NotImplementedException
     */
    public function orderGet(string $orderId, ?string $walletKey = null)
    {
        throw new NotImplementedException();
    }

    /**
     * Returns up to 50 recent orders (both fulfilled and canceled) from the specified market.
     *
     * @throws NotImplementedException
     */
    public function orderHistoryList(string $market)
    {
        throw new NotImplementedException();
    }

    /**
     * Returns up to 100 active orders from the specified market.
     *
     * @throws NotImplementedException
     */
    public function orderList(string $market, ?int $limit = null)
    {
        throw new NotImplementedException();
    }
}
