<?php

namespace MiroslawLach\KangaPHPAPI\Responses;

interface BaseInterface
{
    public function create(): self;

    public function validate(): bool;
}
