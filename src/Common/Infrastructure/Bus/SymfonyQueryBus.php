<?php

namespace Alejgarciarodriguez\PccBasketApp\Common\Infrastructure\Bus;

use Alejgarciarodriguez\PccBasketApp\Common\Domain\Query;
use Alejgarciarodriguez\PccBasketApp\Common\Domain\QueryBus;
use Alejgarciarodriguez\PccBasketApp\Common\Domain\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;

class SymfonyQueryBus implements QueryBus
{
    private $bus;

    public function __construct(MessageBusInterface $queryBus)
    {
        $this->bus = $queryBus;
    }

    public function query(Query $query): Response
    {
        /** @var Response $response */
        $response = $this->bus->dispatch($query)->last(HandledStamp::class)->getResult();
        return $response;
    }
}