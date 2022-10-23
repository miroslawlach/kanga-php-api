<?php

namespace MiroslawLach\KangaPHPAPI\Validators;

use MiroslawLach\KangaPHPAPI\Exceptions\InvalidPermissionsException;
use MiroslawLach\KangaPHPAPI\Exceptions\InvalidResponseStructureException;
use MiroslawLach\KangaPHPAPI\Exceptions\InvalidSignatureException;
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
     */
    public static function validate(array $payload): void
    {
        if (! isset($payload['result'])) {
            throw new InvalidResponseStructureException();
        }

        if ($payload['result'] === ResultEnum::fail->value) {
            match ($payload['code']) {
                401 => throw new InvalidSignatureException(),
                403 => throw new InvalidPermissionsException(),
                429 => throw new TooManyCallsException(),
                1001 => throw new OrderNotCanceledException(),
                default => throw new InvalidResponseStructureException(),
            };
        }
    }
}
