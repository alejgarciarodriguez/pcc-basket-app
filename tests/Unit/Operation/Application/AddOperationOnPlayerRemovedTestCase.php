<?php

namespace Alejgarciarodriguez\PccBasketApp\Tests\Unit\Operation\Application;

use Alejgarciarodriguez\PccBasketApp\Operation\Application\AddOperationOnPlayerRemoved;
use Alejgarciarodriguez\PccBasketApp\Operation\Domain\AddOperation;
use Alejgarciarodriguez\PccBasketApp\Operation\Domain\OperationRepository;
use Alejgarciarodriguez\PccBasketApp\Player\Domain\Event\PlayerRemoved;
use Alejgarciarodriguez\PccBasketApp\Tests\Unit\Common\TestCase;

class AddOperationOnPlayerRemovedTestCase extends TestCase
{
    public function testOperationIsRemoved(): void
    {
        $repositoryMock = $this->createMock(OperationRepository::class);
        $repositoryMock->expects($this->once())->method('save');

        $addOperation = new AddOperation($repositoryMock);
        $useCase = new AddOperationOnPlayerRemoved($addOperation);

        $eventMock = $this->createMock(PlayerRemoved::class);
        $eventMock->expects($this->once())->method('getTimestamp');
        $eventMock->expects($this->once())->method('getPlayer');
        $useCase->__invoke($eventMock);
    }
}