<?php

namespace Alejgarciarodriguez\PccBasketApp\Operation\Domain;

class RemoveType implements OperationType
{
    public function getValue(): string
    {
        return 'REMOVE';
    }
}