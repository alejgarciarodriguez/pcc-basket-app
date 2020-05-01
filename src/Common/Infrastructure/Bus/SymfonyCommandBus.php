<?php

namespace Alejgarciarodriguez\PccBasketApp\Common\Infrastructure\Bus;

use Alejgarciarodriguez\PccBasketApp\Common\Domain\Command;
use Alejgarciarodriguez\PccBasketApp\Common\Domain\CommandBus;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\MessageBusInterface;

class SymfonyCommandBus implements CommandBus
{
    private $bus;

    public function __construct(MessageBusInterface $commandBus)
    {
        $this->bus = $commandBus;
    }

    public function handle(Command $command): Envelope
    {
        return $this->bus->dispatch($command);
    }
}