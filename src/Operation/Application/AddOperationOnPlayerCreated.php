<?php

namespace Alejgarciarodriguez\PccBasketApp\Operation\Application;

use Alejgarciarodriguez\PccBasketApp\Common\Domain\EventHandler;
use Alejgarciarodriguez\PccBasketApp\Operation\Domain\AddOperation;
use Alejgarciarodriguez\PccBasketApp\Operation\Domain\CreateType;
use Alejgarciarodriguez\PccBasketApp\Operation\Domain\Operation;
use Alejgarciarodriguez\PccBasketApp\Player\Domain\Event\PlayerCreated;

class AddOperationOnPlayerCreated implements EventHandler
{
    private $addOperation;

    public function __construct(AddOperation $addOperation)
    {
        $this->addOperation = $addOperation;
    }

    public function __invoke(PlayerCreated $event)
    {
        $this->addOperation->__invoke(new Operation(new CreateType(), $event->getPlayer(), $event->getTimestamp()));
    }
}