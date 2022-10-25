<?php

namespace MiroslawLach\KangaPHPAPI\Responses;

class WalletListAddress extends BaseItem
{
    public string $network;

    public ?string $type;

    public ?string $address;

    public function create(): BaseItem
    {
        $item = $this->item;
        $this->network = $item['network'];

        if (isset($item['type'])) {
            $this->type = $item['type'];
        }

        if (isset($item['address'])) {
            $this->type = $item['address'];
        }

        return $this;
    }

    public function validate(): bool
    {
        if (isset($item['network'])) {
            return true;
        }

        return false;
    }
}
