<?php

namespace Alejgarciarodriguez\PccBasketApp\Tactic\Domain;

class AttackTactic implements Tactic
{
    use DefaultTacticsSupportTrait;

    public function aliases(): array
    {
        return ['ataque', 'attack'];
    }

    public function requirements(): array
    {
        return [
            'BASE' => 1,
            'ALERO' => 1,
            'ESCOLTA' => 1,
            'PIVOT' => 1,
            'ALA-PIVOT' => 1
        ];
    }
}