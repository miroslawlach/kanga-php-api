<?php

namespace MiroslawLach\KangaPHPAPI\Responses;

abstract class BaseItem implements BaseInterface
{
    protected array $item;

    public function __construct(array $item)
    {
        $this->item = $item;
    }

    abstract public function create(): self;

    abstract public function validate(): bool;
}
