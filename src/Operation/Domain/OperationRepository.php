<?php

namespace Alejgarciarodriguez\PccBasketApp\Operation\Domain;

interface OperationRepository
{
    public function save(Operation $operation);
}