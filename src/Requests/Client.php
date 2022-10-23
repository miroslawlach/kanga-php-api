<?php

namespace MiroslawLach\KangaPHPAPI\Requests;

use GuzzleHttp\Exception\GuzzleException;

class Client
{
    private string $baseUri = 'https://api.kanga.exchange/api/v2';

    private \GuzzleHttp\Client $client;

    private ?string $apiKey;

    private ?string $apiSecret;

    public function __construct(?string $apiKey = null, ?string $apiSecret = null)
    {
        $this->apiKey = $apiKey;
        $this->apiSecret = $apiSecret;
        $this->client = new \GuzzleHttp\Client([
            'base_uri' => $this->baseUri
        ]);
    }

    public static function make(?string $apiKey = null, ?string $apiSecret = null): self
    {
        return new self($apiKey, $apiSecret);
    }

    /**
     * @throws GuzzleException
     */
    public function getPublic(string $uri, array $params = []): array
    {
        $client = $this->client;

        return json_decode($client->get($uri, $params)->getBody()->getContents(), true);
    }

    /**
     * @throws GuzzleException
     */
    public function postPrivate(string $uri, array $params = [])
    {
        $client = $this->client;

        $params = array_merge($params, [
            'nonce' => microtime(true),
            'appId' => $this->apiKey
        ]);

        $body = json_encode($params);

        $apiSig = $this->sign($body, $this->apiSecret);

        return json_decode($client->post($uri, [
            'headers' => [
                'api-sig' => $apiSig
            ],
            'json' => $params
        ])->getBody()->getContents(), true);
    }

    private function sign(string $body, string $apiSecret): string
    {
        return hash_hmac('sha512', $body, $apiSecret);
    }
}
