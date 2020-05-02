<?php

namespace Alejgarciarodriguez\PccBasketApp\Tactic\Domain;

class CalculateLineUpResponse
{
    private $lineUp;

    public function __construct(array $lineUp)
    {
        $this->lineUp = $lineUp;
    }

    public function getLineUp(): array
    {
        return $this->lineUp;
    }

    public function __toString()
    {
        return (string)json_encode($this->lineUp, JSON_PRETTY_PRINT);
    }
}