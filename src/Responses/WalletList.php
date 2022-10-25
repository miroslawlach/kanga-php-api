<?php

namespace MiroslawLach\KangaPHPAPI\Responses;

use MiroslawLach\KangaPHPAPI\Exceptions\InvalidResponseStructureException;

class WalletList extends BaseResponse
{
    public array $wallets;

    /**
     * @throws InvalidResponseStructureException
     */
    public function create(): BaseResponse
    {
        $response = $this->response;
        foreach ($response['wallets'] as $wallet) {
            $item = new WalletListItem($wallet);
            if (! $item->validate()) {
                throw new InvalidResponseStructureException();
            }

            $this->wallets[] = $item->create();
        }

        return $this;
    }

    public function validate(): bool
    {
        $response = $this->response;

        if (isset($response['wallets'])) {
            return true;
        }

        return false;
    }
}
