<?php

namespace Alejgarciarodriguez\PccBasketApp\Operation\Domain;

use Alejgarciarodriguez\PccBasketApp\Player\Domain\Player;

class Operation
{
    private $player;
    private $timestamp;
    private $type;

    public function __construct(OperationType $type, Player $player, \DateTimeImmutable $timestamp)
    {
        $this->type = $type;
        $this->player = $player;
        $this->timestamp = $timestamp;
    }

    public function __toString()
    {
        return vsprintf('[%s][%s] Player{number=%d,name="%s",valuation=%d,role="%s"}', [
            $this->getType()->getValue(),
            $this->getTimestamp()->format(\DateTimeImmutable::ATOM),
            $this->getPlayer()->getNumber()->getValue(),
            $this->getPlayer()->getName()->getValue(),
            $this->getPlayer()->getValuation()->getValue(),
            $this->getPlayer()->getRole()->getValue(),
        ]);
    }

    public function getType(): OperationType
    {
        return $this->type;
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