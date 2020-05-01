<?php

namespace Alejgarciarodriguez\PccBasketApp\Player\Domain;

class CreatePlayerResponse
{
    public function __construct(Player $player)
    {
        $this->player = $player;
    }
}