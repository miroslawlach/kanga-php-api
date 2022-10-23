<?php

namespace MiroslawLach\KangaPHPAPI\Responses;

class CreateOrder extends BaseResponse
{
    public string $orderId;

    public function create(): BaseResponse
    {
        $response = $this->response;
        $this->orderId = $response['orderId'];
        return $this;
    }

    public function validate(): bool
    {
        $response = $this->response;

        if (isset($response['orderId'])) {
            return true;
        }

        return false;
    }
}
