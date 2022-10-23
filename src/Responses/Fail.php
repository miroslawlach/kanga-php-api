<?php

namespace MiroslawLach\KangaPHPAPI\Responses;

class Fail
{
    public string $result;

    public int $code;

    public function getCode(): int
    {
        return $this->code;
    }

    public function getMessage(): string
    {
        return match ($this->code) {
            401 => 'Invalid signature',
            403 => 'Invalid permissions',
            429 => 'Too many calls',
            1001 => 'Order not canceled',
            default => 'Unknown status',
        };
    }
}
