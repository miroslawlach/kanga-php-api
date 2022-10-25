<?php

namespace MiroslawLach\KangaPHPAPI\Requests;

use GuzzleHttp\Exception\GuzzleException;
use MiroslawLach\KangaPHPAPI\Exceptions\InvalidPermissionsException;
use MiroslawLach\KangaPHPAPI\Exceptions\InvalidResponseStructureException;
use MiroslawLach\KangaPHPAPI\Exceptions\InvalidSignatureException;
use MiroslawLach\KangaPHPAPI\Exceptions\InvalidWalletKeyException;
use MiroslawLach\KangaPHPAPI\Exceptions\OrderNotCanceledException;
use MiroslawLach\KangaPHPAPI\Exceptions\TooManyCallsException;
use MiroslawLach\KangaPHPAPI\Responses\WalletList;

class WaletRequest
{
    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Returns wallet balances for all assets held by the users
     *
     * @throws GuzzleException
     * @throws InvalidPermissionsException
     * @throws InvalidResponseStructureException
     * @throws InvalidSignatureException
     * @throws OrderNotCanceledException
     * @throws TooManyCallsException
     * @throws InvalidWalletKeyException
     */
    public function list(?string $walletKey = null)
    {
        $params = [];

        if ($walletKey !== null) {
            $params['walletKey'] = $walletKey;
        }

        $response = $this->client->postPrivate('wallet/list', $params);

        return new WalletList($response);
    }
}
