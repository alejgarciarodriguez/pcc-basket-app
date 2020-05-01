<?php

namespace Alejgarciarodriguez\PccBasketApp\Operation\Domain;

interface OperationType
{
    public function getValue(): string;
}