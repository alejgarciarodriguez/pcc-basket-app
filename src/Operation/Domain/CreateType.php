<?php

namespace Alejgarciarodriguez\PccBasketApp\Operation\Domain;

class CreateType implements OperationType
{
    public function getValue(): string
    {
        return 'CREATE';
    }
}