<?php

namespace Alejgarciarodriguez\PccBasketApp\Player\Application\Get;

use Alejgarciarodriguez\PccBasketApp\Common\Domain\QueryHandler;
use Alejgarciarodriguez\PccBasketApp\Player\Domain\GetPlayersResponse;
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
        usort($team, $query->getOrder()->callback());
        return new GetPlayersResponse($team);
    }
}