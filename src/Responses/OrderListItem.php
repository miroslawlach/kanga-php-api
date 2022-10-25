<?php

namespace MiroslawLach\KangaPHPAPI\Responses;

class OrderListItem extends BaseItem
{
    public string $id;

    public string $type;

    public string $quantity;

    public string $remainingQuantity;

    public string $price;

    public string $currentValue;

    public string $created;

    public function create(): self
    {
        $item = $this->item;
        $this->id = $item['id'];
        $this->type = $item['type'];
        $this->quantity = $item['quantity'];
        $this->remainingQuantity = $item['remainingQuantity'];
        $this->price = $item['price'];
        $this->currentValue = $item['currentValue'];
        $this->created = $item['created'];

        return $this;
    }

    public function validate(): bool
    {
        if (
            isset(
                $item['id'],
                $item['type'],
                $item['quantity'],
                $item['remainingQuantity'],
                $item['price'],
                $item['currentValue'],
                $item['created'],
            )
        ) {
            return true;
        }

        return false;
    }
}
