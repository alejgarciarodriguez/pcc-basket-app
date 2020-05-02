<?php

namespace Alejgarciarodriguez\PccBasketApp\Player\Domain;

class RemovePlayerResponse
{
    private $number;

    public function __construct(int $number)
    {
        $this->number = $number;
    }

    public function __toString()
    {
        return (string)json_encode(sprintf('Player with number "%d" was removed', $this->number));
    }
}