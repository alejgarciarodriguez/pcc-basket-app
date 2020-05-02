<?php

namespace Alejgarciarodriguez\PccBasketApp\Tactic\Application;

use Alejgarciarodriguez\PccBasketApp\Tactic\Domain\Exception\TacticNotFound;

class CalculateLineUpQuery
{
    private $tactic;

    public function __construct(?string $tactic)
    {
        if(!is_string($tactic)){
            throw new TacticNotFound();
        }

        $this->tactic = $tactic;
    }

    public function getTactic(): string
    {
        return $this->tactic;
    }
}