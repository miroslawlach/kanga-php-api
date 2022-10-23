<?php

namespace MiroslawLach\KangaPHPAPI\Requests;

use GuzzleHttp\Exception\GuzzleException;
use MiroslawLach\KangaPHPAPI\Exceptions\InvalidPermissionsException;
use MiroslawLach\KangaPHPAPI\Exceptions\InvalidResponseStructureException;
use MiroslawLach\KangaPHPAPI\Exceptions\InvalidSignatureException;
use MiroslawLach\KangaPHPAPI\Exceptions\NotImplementedException;
use MiroslawLach\KangaPHPAPI\Exceptions\OrderNotCanceledException;
use MiroslawLach\KangaPHPAPI\Exceptions\TooManyCallsException;
use MiroslawLach\KangaPHPAPI\Responses\CancelOrder;
use MiroslawLach\KangaPHPAPI\Responses\OrderBook;
use MiroslawLach\KangaPHPAPI\Types\Type;

class TradeRequest
{
    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

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
     * @throws GuzzleException
     * @throws InvalidPermissionsException
     * @throws InvalidResponseStructureException
     * @throws InvalidSignatureException
     * @throws OrderNotCanceledException
     * @throws TooManyCallsException
     */
    public function orderBook(string $market): OrderBook
    {
        $params = [
            'market' => $market
        ];

        $response = $this->client->postPrivate('market/order/book', $params);

        return new OrderBook($response);
    }

    /**
     * Cancels the order identified by orderId.
     *
     * @throws GuzzleException
     * @throws InvalidPermissionsException
     * @throws InvalidResponseStructureException
     * @throws InvalidSignatureException
     * @throws OrderNotCanceledException
     * @throws TooManyCallsException
     */
    public function orderCancel(string $orderId): CancelOrder
    {
        $params = [
            'orderId' => $orderId
        ];

        $response = $this->client->postPrivate('market/order/cancel', $params);

        return new CancelOrder($response);
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
