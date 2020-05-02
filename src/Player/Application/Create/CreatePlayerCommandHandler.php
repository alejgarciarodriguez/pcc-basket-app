<?php

namespace Alejgarciarodriguez\PccBasketApp\Player\Application\Create;

use Alejgarciarodriguez\PccBasketApp\Common\Domain\CommandHandler;
use Alejgarciarodriguez\PccBasketApp\Common\Domain\EventBus;
use Alejgarciarodriguez\PccBasketApp\Player\Domain\Event\PlayerCreated;
use Alejgarciarodriguez\PccBasketApp\Player\Domain\Exception\PlayerAlreadyExists;
use Alejgarciarodriguez\PccBasketApp\Player\Domain\Player;
use Alejgarciarodriguez\PccBasketApp\Player\Domain\PlayerFinder;
use Alejgarciarodriguez\PccBasketApp\Player\Domain\PlayerRepository;
use Alejgarciarodriguez\PccBasketApp\Player\Domain\ValueObject\PlayerName;
use Alejgarciarodriguez\PccBasketApp\Player\Domain\ValueObject\PlayerNumber;
use Alejgarciarodriguez\PccBasketApp\Player\Domain\ValueObject\PlayerRole;
use Alejgarciarodriguez\PccBasketApp\Player\Domain\ValueObject\PlayerValuation;

class CreatePlayerCommandHandler implements CommandHandler
{
    private $repository;
    private $finder;
    private $eventBus;

    public function __construct(
        PlayerRepository $playerRepository,
        PlayerFinder $finder,
        EventBus $eventBus)
    {
        $this->repository = $playerRepository;
        $this->finder = $finder;
        $this->eventBus = $eventBus;
    }

    public function __invoke(CreatePlayerCommand $command)
    {
        $player = Player::create(
            new PlayerNumber($command->getNumber()),
            new PlayerName($command->getName()),
            new PlayerRole($command->getRole()),
            new PlayerValuation($command->getValuation()),
        );

        if(null !== $this->finder->find($player->getNumber())){
            throw new PlayerAlreadyExists();
        }

        $this->repository->save($player);
        $this->eventBus->handle(new PlayerCreated($player));
    }
}