<?php

namespace Alejgarciarodriguez\PccBasketApp\Tests\Unit\Player\Application;

use Alejgarciarodriguez\PccBasketApp\Common\Domain\EventBus;
use Alejgarciarodriguez\PccBasketApp\Player\Application\Create\CreatePlayerCommand;
use Alejgarciarodriguez\PccBasketApp\Player\Application\Create\CreatePlayerCommandHandler;
use Alejgarciarodriguez\PccBasketApp\Player\Domain\Exception\PlayerAlreadyExists;
use Alejgarciarodriguez\PccBasketApp\Player\Domain\Exception\PlayerRoleNotValid;
use Alejgarciarodriguez\PccBasketApp\Player\Domain\Player;
use Alejgarciarodriguez\PccBasketApp\Player\Domain\PlayerFinder;
use Alejgarciarodriguez\PccBasketApp\Player\Domain\PlayerRepository;
use Alejgarciarodriguez\PccBasketApp\Tests\Unit\Common\TestCase as TestCase;
use Alejgarciarodriguez\PccBasketApp\Tests\Unit\Player\Domain\PlayerRoleGenerator;

class CreatePlayerTest extends TestCase
{
    public function testPlayerIsCreated(): void
    {
        $command = new CreatePlayerCommand(
            $this->getFaker()->numberBetween(1, 99),
            $this->getFaker()->name,
            PlayerRoleGenerator::random(),
            $this->getFaker()->numberBetween(0,100)
        );

        $repo = $this->createMock(PlayerRepository::class);
        $repo->expects($this->once())->method('save');

        $eventBus = $this->createMock(EventBus::class);
        $eventBus->expects($this->once())->method('handle');

        $finder = $this->createMock(PlayerFinder::class);
        $finder->expects($this->once())->method('find')->willReturn(null);

        $handler = new CreatePlayerCommandHandler($repo, $finder, $eventBus);

        $handler->__invoke($command);
    }

    public function testRoleIsNotValid()
    {
        $this->expectException(PlayerRoleNotValid::class);

        $command = new CreatePlayerCommand(
            $this->getFaker()->numberBetween(1, 99),
            $this->getFaker()->name,
            $this->getFaker()->name,
            $this->getFaker()->numberBetween(0,100)
        );

        $repo = $this->createMock(PlayerRepository::class);
        $repo->expects($this->never())->method('save');

        $eventBus = $this->createMock(EventBus::class);
        $eventBus->expects($this->never())->method('handle');

        $finder = $this->createMock(PlayerFinder::class);
        $finder->expects($this->never())->method('find')->willReturn(null);

        $handler = new CreatePlayerCommandHandler($repo, $finder, $eventBus);

        $handler->__invoke($command);
    }

    public function testExceptionIsThrownIfPlayerAlreadyExists()
    {
        $this->expectException(PlayerAlreadyExists::class);

        $command = new CreatePlayerCommand(
            $this->getFaker()->numberBetween(1, 99),
            $this->getFaker()->name,
            PlayerRoleGenerator::random(),
            $this->getFaker()->numberBetween(0,100)
        );

        $repo = $this->createMock(PlayerRepository::class);
        $repo->expects($this->never())->method('save');

        $eventBus = $this->createMock(EventBus::class);
        $eventBus->expects($this->never())->method('handle');

        $finder = $this->createMock(PlayerFinder::class);
        $finder->expects($this->once())->method('find')
            ->willReturn($this->createMock(Player::class));

        $handler = new CreatePlayerCommandHandler($repo, $finder, $eventBus);

        $handler->__invoke($command);
    }

    // TODO: test value object validations ...

}