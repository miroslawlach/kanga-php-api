<?php

namespace MiroslawLach\KangaPHPAPI\Responses;

use MiroslawLach\KangaPHPAPI\Exceptions\InvalidResponseStructureException;

class WalletListItem extends BaseItem
{
    public string $currencyCode;

    public string $value;

    public string $lockedValue;

    public array $addresses;

    /**
     * @throws InvalidResponseStructureException
     */
    public function create(): BaseItem
    {
        $item = $this->item;
        $this->currencyCode = $item['currencyCode'];
        $this->value = $item['value'];
        $this->lockedValue = $item['lockedValue'];
        $this->addresses = $item['addresses'];
        foreach ($item['addresses'] as $address) {
            $addressItem = new WalletListAddress($address);
            if (! $addressItem->validate()) {
                throw new InvalidResponseStructureException();
            }

            $this->addresses[] = $addressItem->create();
        }

        return $this;
    }

    public function validate(): bool
    {
        if (
            isset(
                $item['currencyCode'],
                $item['value'],
                $item['lockedValue'],
                $item['addresses']
            )
        ) {
            return true;
        }

        return false;
    }
}
