<?php

namespace MiroslawLach\KangaPHPAPI\Responses;

use MiroslawLach\KangaPHPAPI\Exceptions\InvalidPermissionsException;
use MiroslawLach\KangaPHPAPI\Exceptions\InvalidResponseStructureException;
use MiroslawLach\KangaPHPAPI\Exceptions\InvalidSignatureException;
use MiroslawLach\KangaPHPAPI\Exceptions\InvalidWalletKeyException;
use MiroslawLach\KangaPHPAPI\Exceptions\OrderNotCanceledException;
use MiroslawLach\KangaPHPAPI\Exceptions\TooManyCallsException;
use MiroslawLach\KangaPHPAPI\Validators\Response;

abstract class BaseResponse implements BaseInterface
{
    protected array $response;

    /**
     * @throws InvalidSignatureException
     * @throws OrderNotCanceledException
     * @throws TooManyCallsException
     * @throws InvalidPermissionsException
     * @throws InvalidResponseStructureException
     * @throws InvalidWalletKeyException
     */
    public function __construct(array $response)
    {
        Response::validate($response);
        $this->response = $response;
    }

    abstract public function create(): self;

    abstract public function validate(): bool;
}
