<?php

namespace Alejgarciarodriguez\PccBasketApp\Tests\Unit\Operation\Application;

use Alejgarciarodriguez\PccBasketApp\Operation\Application\AddOperationOnPlayerCreated;
use Alejgarciarodriguez\PccBasketApp\Operation\Domain\AddOperation;
use Alejgarciarodriguez\PccBasketApp\Operation\Domain\OperationRepository;
use Alejgarciarodriguez\PccBasketApp\Player\Domain\Event\PlayerCreated;
use Alejgarciarodriguez\PccBasketApp\Tests\Unit\Common\TestCase;

class AddOperationOnPlayerCreatedTest extends TestCase
{
    public function testOperationIsCreated(): void
    {
        $repositoryMock = $this->createMock(OperationRepository::class);
        $repositoryMock->expects($this->once())->method('save');

        $addOperation = new AddOperation($repositoryMock);
        $useCase = new AddOperationOnPlayerCreated($addOperation);

        $eventMock = $this->createMock(PlayerCreated::class);
        $eventMock->expects($this->once())->method('getTimestamp');
        $eventMock->expects($this->once())->method('getPlayer');
        $useCase->__invoke($eventMock);
    }
}