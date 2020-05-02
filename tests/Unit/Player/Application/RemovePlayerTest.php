<?php

namespace Alejgarciarodriguez\PccBasketApp\Tests\Unit\Player\Application;

use Alejgarciarodriguez\PccBasketApp\Common\Domain\EventBus;
use Alejgarciarodriguez\PccBasketApp\Player\Application\Remove\RemovePlayerCommand;
use Alejgarciarodriguez\PccBasketApp\Player\Application\Remove\RemovePlayerCommandHandler;
use Alejgarciarodriguez\PccBasketApp\Player\Domain\Player;
use Alejgarciarodriguez\PccBasketApp\Player\Domain\PlayerFinder;
use Alejgarciarodriguez\PccBasketApp\Player\Domain\PlayerRepository;
use Alejgarciarodriguez\PccBasketApp\Tests\Unit\Common\TestCase;

class RemovePlayerTest extends TestCase
{
    public function testRemovePlayerIfExists(): void
    {
        $command = new RemovePlayerCommand(
            $this->getFaker()->numberBetween(1, 99)
        );

        $repo = $this->createMock(PlayerRepository::class);
        $repo->expects($this->once())->method('remove');

        $eventBus = $this->createMock(EventBus::class);
        $eventBus->expects($this->once())->method('handle');

        $finder = $this->createMock(PlayerFinder::class);
        $finder->expects($this->once())->method('find')->willReturn($this->createMock(Player::class));

        $handler = new RemovePlayerCommandHandler($repo, $finder, $eventBus);

        $handler->__invoke($command);
    }
}