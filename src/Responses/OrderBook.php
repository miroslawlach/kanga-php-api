<?php

namespace MiroslawLach\KangaPHPAPI\Responses;

use MiroslawLach\KangaPHPAPI\Exceptions\InvalidResponseStructureException;

class OrderBook extends BaseResponse
{
    public array $bids;

    public array $asks;

    /**
     * @throws InvalidResponseStructureException
     */
    public function create(): BaseResponse
    {
        $response = $this->response;
        $asks = [];
        $bids = [];
        foreach ($response['bids'] as $bid) {
            $item = new OrderBookItem($bid);
            if (! $item->validate()) {
                throw new InvalidResponseStructureException();
            }

            $bids[] = $item->create();
        }

        foreach ($response['asks'] as $ask) {
            $item = new OrderBookItem($ask);
            if (! $item->validate()) {
                throw new InvalidResponseStructureException();
            }

            $asks[] = $item->create();
        }

        $this->asks = $this->sortAsks($asks);
        $this->bids = $this->sortBids($bids);

        return $this;
    }

    public function validate(): bool
    {
        $response = $this->response;

        if (isset($response['bids'], $response['asks'])) {
            return true;
        }

        return false;
    }

    private function sortAsks(array $asks): array
    {
        // TODO implement
        return $asks;
    }

    private function sortBids(array $bids): array
    {
        // TODO implement
        return $bids;
    }
}
