<?php

namespace Alejgarciarodriguez\PccBasketApp\Operation\Domain;

use Alejgarciarodriguez\PccBasketApp\Common\Domain\EventHandler;
use Alejgarciarodriguez\PccBasketApp\Player\Domain\Event\PlayerRemoved;

class AddOperationOnPlayerRemoved implements EventHandler
{
    private $addOperation;

    public function __construct(AddOperation $addOperation)
    {
        $this->addOperation = $addOperation;
    }

    public function __invoke(PlayerRemoved $event)
    {
        $this->addOperation->__invoke(new Operation(new RemoveType(), $event->getPlayer(), $event->getTimestamp()));
    }
}