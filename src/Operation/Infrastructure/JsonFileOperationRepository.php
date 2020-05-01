<?php

namespace Alejgarciarodriguez\PccBasketApp\Operation\Infrastructure;

use Alejgarciarodriguez\PccBasketApp\Operation\Domain\Operation;
use Alejgarciarodriguez\PccBasketApp\Operation\Domain\OperationRepository;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class JsonFileOperationRepository implements OperationRepository
{
    private $parameterBag;

    public function __construct(ParameterBagInterface $parameterBag)
    {
        $this->parameterBag = $parameterBag;
    }

    private function getFile()
    {
        return $this->parameterBag->get('kernel.project_dir') . '/../../operations.txt';
    }

    private function createIfNotExists(): void
    {
        if(!file_exists($this->getFile())){
            file_put_contents($this->getFile(), null);
        }
    }

    public function save(Operation $operation): void
    {
        $this->createIfNotExists();
        file_put_contents($this->getFile(), $operation->__toString() . PHP_EOL, FILE_APPEND);
    }
}