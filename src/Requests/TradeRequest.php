<?php

namespace MiroslawLach\KangaPHPAPI\Requests;

use GuzzleHttp\Exception\GuzzleException;
use MiroslawLach\KangaPHPAPI\Exceptions\InvalidParamException;
use MiroslawLach\KangaPHPAPI\Exceptions\InvalidPermissionsException;
use MiroslawLach\KangaPHPAPI\Exceptions\InvalidResponseStructureException;
use MiroslawLach\KangaPHPAPI\Exceptions\InvalidSignatureException;
use MiroslawLach\KangaPHPAPI\Exceptions\InvalidWalletKeyException;
use MiroslawLach\KangaPHPAPI\Exceptions\NotImplementedException;
use MiroslawLach\KangaPHPAPI\Exceptions\OrderNotCanceledException;
use MiroslawLach\KangaPHPAPI\Exceptions\TooManyCallsException;
use MiroslawLach\KangaPHPAPI\Responses\CancelOrder;
use MiroslawLach\KangaPHPAPI\Responses\CreateOrder;
use MiroslawLach\KangaPHPAPI\Responses\GetOrder;
use MiroslawLach\KangaPHPAPI\Responses\OrderBook;
use MiroslawLach\KangaPHPAPI\Responses\OrderHistory;
use MiroslawLach\KangaPHPAPI\Responses\OrderList;
use MiroslawLach\KangaPHPAPI\Types\Type;

class TradeRequest
{
    private $client;

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
     * @throws InvalidWalletKeyException
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
     * @throws InvalidWalletKeyException
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
     * Creates a new order. On success returns orderId.
     *
     * @throws GuzzleException
     * @throws InvalidPermissionsException
     * @throws InvalidResponseStructureException
     * @throws InvalidSignatureException
     * @throws OrderNotCanceledException
     * @throws TooManyCallsException
     * @throws InvalidWalletKeyException
     * @throws InvalidParamException
     */
    public function orderCreate(string $quantity, string $type, string $market, ?string $price = null, ?string $valueLimit = null): CreateOrder
    {
        if (! in_array($type, [Type::ASK, Type::BID])) {
            throw new InvalidParamException();
        }

        $params = [
            'quantity' => $quantity,
            'type' => $type,
            'market' => $market,
        ];

        if ($price !== null) {
            $params['price'] = $price;
        }

        if ($valueLimit !== null) {
            $params['valueLimit'] = $valueLimit;
        }

        $response = $this->client->postPrivate('market/order/create', $params);

        return new CreateOrder($response);
    }

    /**
     * Returns the details of the specified order.
     *
     * @throws GuzzleException
     * @throws InvalidPermissionsException
     * @throws InvalidResponseStructureException
     * @throws InvalidSignatureException
     * @throws OrderNotCanceledException
     * @throws TooManyCallsException
     * @throws InvalidWalletKeyException
     */
    public function orderGet(string $orderId, ?string $walletKey = null): GetOrder
    {
        $params = [
            'orderId' => $orderId,
        ];

        if ($walletKey !== null) {
            $params['walletKey'] = $walletKey;
        }

        $response = $this->client->postPrivate('market/order/get', $params);

        return new GetOrder($response);
    }

    /**
     * Returns up to 50 recent orders (both fulfilled and canceled) from the specified market.
     *
     * @throws GuzzleException
     * @throws InvalidPermissionsException
     * @throws InvalidResponseStructureException
     * @throws InvalidSignatureException
     * @throws OrderNotCanceledException
     * @throws TooManyCallsException
     * @throws InvalidWalletKeyException
     */
    public function orderHistoryList(string $market): OrderHistory
    {
        $params = [
            'market' => $market,
        ];

        $response = $this->client->postPrivate('market/history/list', $params);

        return new OrderHistory($response);
    }

    /**
     * Returns up to 100 active orders from the specified market.
     *
     * @throws GuzzleException
     * @throws InvalidPermissionsException
     * @throws InvalidResponseStructureException
     * @throws InvalidSignatureException
     * @throws OrderNotCanceledException
     * @throws TooManyCallsException
     * @throws InvalidWalletKeyException
     */
    public function orderList(string $market, ?int $limit = null): OrderList
    {
        $params = [
            'market' => $market,
        ];

        if ($limit !== null) {
            $params['limit'] = $limit;
        }

        $response = $this->client->postPrivate('market/history/list', $params);

        return new OrderList($response);
    }
}
