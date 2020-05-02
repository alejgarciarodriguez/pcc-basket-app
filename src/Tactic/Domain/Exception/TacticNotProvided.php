<?php

namespace Alejgarciarodriguez\PccBasketApp\Tactic\Domain\Exception;

use Alejgarciarodriguez\PccBasketApp\Common\Domain\Exception;

class TacticNotProvided extends Exception
{
    public function __construct($message = "No tactic provided")
    {
        parent::__construct($message);
    }
}