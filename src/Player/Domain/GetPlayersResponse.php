<?php

namespace Alejgarciarodriguez\PccBasketApp\Player\Domain;

use Alejgarciarodriguez\PccBasketApp\Common\Domain\Response;

class GetPlayersResponse implements Response
{
    private $team;

    /**
     * GetPlayersResponse constructor.
     * @param Player[] $team
     */
    public function __construct(array $team = [])
    {
        $this->team = $team;
    }

    /**
     * @return Player[]
     */
    public function getTeam(): array
    {
        return $this->team;
    }

    public function __toString(): string
    {
        return (string)json_encode($this->team);
    }
}