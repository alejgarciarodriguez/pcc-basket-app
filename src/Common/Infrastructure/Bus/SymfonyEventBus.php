<?php

namespace Alejgarciarodriguez\PccBasketApp\Common\Infrastructure\Bus;

use Alejgarciarodriguez\PccBasketApp\Common\Domain\Event;
use Alejgarciarodriguez\PccBasketApp\Common\Domain\EventBus;
use Symfony\Component\Messenger\MessageBusInterface;

class SymfonyEventBus implements EventBus
{
    private $bus;

    public function __construct(MessageBusInterface $eventBus)
    {
        $this->bus = $eventBus;
    }

    public function handle(Event $event)
    {
        $this->bus->dispatch($event);
    }
}