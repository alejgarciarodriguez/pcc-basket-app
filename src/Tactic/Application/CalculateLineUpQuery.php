<?php

namespace Alejgarciarodriguez\PccBasketApp\Tactic\Application;

use Alejgarciarodriguez\PccBasketApp\Tactic\Domain\Exception\TacticNotProvided;

class CalculateLineUpQuery
{
    private $tactic;

    public function __construct(?string $tactic)
    {
        if(!is_string($tactic)){
            throw new TacticNotProvided();
        }

        $this->tactic = $tactic;
    }

    public function getTactic(): string
    {
        return $this->tactic;
    }
}