<?php

namespace MiroslawLach\KangaPHPAPI\Responses;

use MiroslawLach\KangaPHPAPI\Exceptions\InvalidResponseStructureException;

class OrderList extends BaseResponse
{
    public array $orders;

    /**
     * @throws InvalidResponseStructureException
     */
    public function create(): self
    {
        $response = $this->response;
        foreach ($response['orders'] as $order) {
            $item = new OrderListItem($order);
            if (! $item->validate()) {
                throw new InvalidResponseStructureException();
            }

            $this->orders[] = $item->create();
        }

        return $this;
    }

    public function validate(): bool
    {
        $response = $this->response;

        if (isset($response['orders'])) {
            return true;
        }

        return false;
    }
}
