<?php

namespace MiroslawLach\KangaPHPAPI\Responses;

class OrderHistoryItem extends BaseItem
{
    public string $type;

    public string $quantity;

    public string $remainingQuantity;

    public string $price;

    public string $currentValue;

    public string $state;

    public string $created;

    public ?string $closed = null;

    public function create(): self
    {
        $item = $this->item;
        $this->type = $item['type'];
        $this->quantity = $item['quantity'];
        $this->remainingQuantity = $item['remainingQuantity'];
        $this->price = $item['price'];
        $this->currentValue = $item['currentValue'];
        $this->state = $item['state'];
        $this->created = $item['created'];
        if (isset($item['closed'])) {
            $this->closed = $item['closed'];
        }

        return $this;
    }

    public function validate(): bool
    {
        if (
            isset(
                $item['type'],
                $item['quantity'],
                $item['remainingQuantity'],
                $item['price'],
                $item['currentValue'],
                $item['state'],
                $item['created'],
            )
        ) {
            return true;
        }

        return false;
    }
}
