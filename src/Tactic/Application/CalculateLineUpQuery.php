<?php

namespace Alejgarciarodriguez\PccBasketApp\Tactic\Application;

use Alejgarciarodriguez\PccBasketApp\Tactics\Domain\Exception\TacticsNotFound;

class CalculateLineUpQuery
{
    private $tactics;

    public function __construct(?string $tactics)
    {
        if(!is_string($tactics)){
            throw new TacticsNotFound();
        }

        $this->tactics = $tactics;
    }

    public function getTactics(): string
    {
        return $this->tactics;
    }
}