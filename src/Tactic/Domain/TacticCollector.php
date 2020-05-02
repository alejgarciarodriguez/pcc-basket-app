<?php

namespace Alejgarciarodriguez\PccBasketApp\Tactic\Domain;

class TacticCollector
{
    /** @var Tactic[] */
    private $tactics = [];

    public function addTactic(Tactic $tactic): void
    {
        $this->tactics[] = $tactic;
    }

    /**
     * @return Tactic[]|array
     */
    public function get(): array
    {
        return $this->tactics;
    }
}