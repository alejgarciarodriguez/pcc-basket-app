<?php

namespace Alejgarciarodriguez\PccBasketApp\Player\Domain\Event;

use Alejgarciarodriguez\PccBasketApp\Common\Domain\Event;
use Alejgarciarodriguez\PccBasketApp\Player\Domain\Player;

class PlayerRemoved implements Event
{
    private $player;
    private $timestamp;

    public function __construct(Player $player)
    {
        $this->player = $player;
        $this->timestamp = new \DateTimeImmutable();
    }

    public function getTimestamp(): \DateTimeImmutable
    {
        return $this->timestamp;
    }

    public function getPlayer(): Player
    {
        return $this->player;
    }
}