<?php

namespace MiroslawLach\KangaPHPAPI\Responses;

class OrderBookItem extends BaseItem
{
    public string $remaining;

    public string $price;

    public function create(): self
    {
        $item = $this->item;
        $this->remaining = $item['remaining'];
        $this->price = $item['price'];
        return $this;
    }

    public function validate(): bool
    {
        if (isset($item['remaining'], $item['price'])) {
            return true;
        }

        return false;
    }
}
