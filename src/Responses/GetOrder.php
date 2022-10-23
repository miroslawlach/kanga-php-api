<?php

namespace MiroslawLach\KangaPHPAPI\Responses;

class GetOrder extends BaseResponse
{
    public string $state;

    public string $type;

    public string $quantity;

    public string $remainingQuantity;

    public string $currentValue;

    public function create(): BaseResponse
    {
        $response = $this->response;
        $this->state = $response['state'];
        $this->type = $response['type'];
        $this->quantity = $response['quantity'];
        $this->remainingQuantity = $response['remainingQuantity'];
        $this->currentValue = $response['currentValue'];
        return $this;
    }

    public function validate(): bool
    {
        $response = $this->response;

        if (
            isset(
                $response['state'],
                $response['type'],
                $response['quantity'],
                $response['remainingQuantity'],
                $response['currentValue'],
            )
        ) {
            return true;
        }

        return false;
    }
}
