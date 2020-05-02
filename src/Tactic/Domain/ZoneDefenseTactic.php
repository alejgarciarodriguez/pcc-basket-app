<?php

namespace Alejgarciarodriguez\PccBasketApp\Tactic\Domain;

class ZoneDefenseTactic implements Tactic
{
    use DefaultTacticsSupportTrait;

    public function aliases(): array
    {
        return ['zone-defense', 'defense-zone', 'defensa-zonal'];
    }

    public function requirements(): array
    {
        return [
            'BASE' => 2,
            'ESCOLTA' => 0,
            'ALERO' => 1,
            'PIVOT' => 1,
            'ALA-PIVOT' => 1
        ];
    }
}