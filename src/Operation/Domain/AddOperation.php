<?php

namespace Alejgarciarodriguez\PccBasketApp\Operation\Domain;

class AddOperation
{
    private $operationRepository;

    public function __construct(OperationRepository $operationRepository)
    {
        $this->operationRepository = $operationRepository;
    }

    public function __invoke(Operation $operation)
    {
        $this->operationRepository->save($operation);
    }
}