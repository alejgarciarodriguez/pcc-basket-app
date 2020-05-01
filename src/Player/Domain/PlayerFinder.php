<?php

namespace Alejgarciarodriguez\PccBasketApp\Player\Domain;

use Alejgarciarodriguez\PccBasketApp\Player\Domain\ValueObject\PlayerNumber;

class PlayerFinder
{
    private $repository;

    public function __construct(PlayerRepository $playerRepository)
    {
        $this->repository = $playerRepository;
    }

    public function find(PlayerNumber $playerNumber): ?Player
    {
        /** @var Player|null $player */
        return $this->repository->find($playerNumber);
    }
}