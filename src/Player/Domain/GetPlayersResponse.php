<?php

namespace Alejgarciarodriguez\PccBasketApp\Player\Domain;

class GetPlayersResponse
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
        return (string)json_encode($this->team, JSON_PRETTY_PRINT);
    }
}