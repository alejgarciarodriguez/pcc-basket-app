<?php

namespace Alejgarciarodriguez\PccBasketApp\Tactic\Domain;

trait DefaultTacticsSupportTrait
{
    public function supports(array $playersGroupedByRole): bool
    {
        foreach($this->requirements() as $role => $numberRequirement){

            $existsRole = array_key_exists($role, $playersGroupedByRole);

            if($numberRequirement > 0 && !$existsRole){
                return false;
            }

            if($existsRole && $numberRequirement > count($playersGroupedByRole[$role])){
                return false;
            }
        }

        return true;
    }
}