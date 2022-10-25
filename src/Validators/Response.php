<?php

namespace MiroslawLach\KangaPHPAPI\Validators;

use MiroslawLach\KangaPHPAPI\Exceptions\InvalidPermissionsException;
use MiroslawLach\KangaPHPAPI\Exceptions\InvalidResponseStructureException;
use MiroslawLach\KangaPHPAPI\Exceptions\InvalidSignatureException;
use MiroslawLach\KangaPHPAPI\Exceptions\InvalidWalletKeyException;
use MiroslawLach\KangaPHPAPI\Exceptions\OrderNotCanceledException;
use MiroslawLach\KangaPHPAPI\Exceptions\TooManyCallsException;
use MiroslawLach\KangaPHPAPI\Types\Result as ResultEnum;

class Response
{
    /**
     * @throws InvalidSignatureException
     * @throws InvalidResponseStructureException
     * @throws InvalidPermissionsException
     * @throws TooManyCallsException
     * @throws OrderNotCanceledException
     * @throws InvalidWalletKeyException
     */
    public static function validate(array $payload): void
    {
        if (! isset($payload['result'])) {
            throw new InvalidResponseStructureException();
        }

        if ($payload['result'] === ResultEnum::FAIL) {
            switch ($payload['code']) {
                case 401:
                case 9000:
                    throw new InvalidSignatureException();
                case 403:
                case 9001:
                    throw new InvalidPermissionsException();
                case 429:
                    throw new TooManyCallsException();
                case 1001:
                    throw new OrderNotCanceledException();
                case 9002:
                    throw new InvalidWalletKeyException();
                default:
                    throw new InvalidResponseStructureException();
            }
        }
    }
}
