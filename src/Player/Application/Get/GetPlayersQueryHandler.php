<?php

namespace Alejgarciarodriguez\PccBasketApp\Player\Application\Get;

use Alejgarciarodriguez\PccBasketApp\Common\Domain\QueryHandler;
use Alejgarciarodriguez\PccBasketApp\Player\Domain\GetPlayersResponse;
use Alejgarciarodriguez\PccBasketApp\Player\Domain\OrderDir;
use Alejgarciarodriguez\PccBasketApp\Player\Domain\OrderField;
use Alejgarciarodriguez\PccBasketApp\Player\Domain\PlayerRepository;

class GetPlayersQueryHandler implements QueryHandler
{
    private $playerRepository;

    public function __construct(PlayerRepository $playerRepository)
    {
        $this->playerRepository = $playerRepository;
    }

    public function __invoke(GetPlayersQuery $query)
    {
        $team = $this->playerRepository->findAll();

        $sortField = new OrderField($query->getField());
        $sortDir = new OrderDir($query->getDir());

        return new GetPlayersResponse($team);
    }
}