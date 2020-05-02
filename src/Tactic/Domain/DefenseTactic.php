<?php

namespace Alejgarciarodriguez\PccBasketApp\Tactic\Domain;

class DefenseTactic implements Tactic
{
    use DefaultTacticsSupportTrait;

    public function aliases(): array
    {
        return ['defensa', 'defense'];
    }

    public function requirements(): array
    {
        return [
            'BASE' => 1,
            'ESCOLTA' => 2,
            'ALA-PIVOT' => 1,
            'PIVOT' => 1,
            'ALERO' => 0
        ];
    }
}