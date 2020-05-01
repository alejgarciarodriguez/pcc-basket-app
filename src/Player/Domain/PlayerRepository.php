<?php

namespace Alejgarciarodriguez\PccBasketApp\Player\Domain;

use Alejgarciarodriguez\PccBasketApp\Player\Domain\ValueObject\PlayerNumber;

interface PlayerRepository
{
    public function save(Player $player): void;

    public function remove(PlayerNumber $playerNumber): void;

    public function find(PlayerNumber $playerNumber): ?Player;

    /** @return Player[] */
    public function findAll(): array;
}