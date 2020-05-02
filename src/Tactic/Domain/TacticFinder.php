<?php

namespace Alejgarciarodriguez\PccBasketApp\Tactic\Domain;

use Alejgarciarodriguez\PccBasketApp\Tactic\Domain\Exception\TacticNotFound;

class TacticFinder
{
    private $tacticsCollector;

    public function __construct(TacticCollector $tacticsCollector)
    {
        $this->tacticsCollector = $tacticsCollector;
    }

    /**
     * @param string $tactics
     * @return Tactic
     * @throws TacticNotFound
     */
    public function __invoke(string $tactics): Tactic
    {
        foreach($this->tacticsCollector->get() as $each){
            if(in_array($tactics, $each->aliases(), true)){
                return $each;
            }
        }

        throw new TacticNotFound();
    }
}