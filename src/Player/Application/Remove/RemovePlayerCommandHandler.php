<?php

namespace Alejgarciarodriguez\PccBasketApp\Player\Application\Remove;

use Alejgarciarodriguez\PccBasketApp\Common\Domain\CommandHandler;
use Alejgarciarodriguez\PccBasketApp\Common\Domain\EventBus;
use Alejgarciarodriguez\PccBasketApp\Player\Domain\Event\PlayerRemoved;
use Alejgarciarodriguez\PccBasketApp\Player\Domain\Exception\PlayerNotFound;
use Alejgarciarodriguez\PccBasketApp\Player\Domain\PlayerFinder;
use Alejgarciarodriguez\PccBasketApp\Player\Domain\PlayerRepository;
use Alejgarciarodriguez\PccBasketApp\Player\Domain\ValueObject\PlayerNumber;

class RemovePlayerCommandHandler implements CommandHandler
{
    private $playerRepository;
    private $playerFinder;
    private $eventBus;

    public function __construct(
        PlayerRepository $playerRepository,
        PlayerFinder $playerFinder,
        EventBus $eventBus
    )
    {
        $this->playerRepository = $playerRepository;
        $this->playerFinder = $playerFinder;
        $this->eventBus = $eventBus;
    }

    public function __invoke(RemovePlayerCommand $command)
    {
        $player = $this->playerFinder->find(new PlayerNumber($command->getNumber()));

        if(null === $player){
            throw new PlayerNotFound();
        }

        $this->playerRepository->remove($player->getNumber());
        $this->eventBus->handle(new PlayerRemoved($player));
    }
}