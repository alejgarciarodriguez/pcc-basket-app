<?php

namespace Alejgarciarodriguez\PccBasketApp\Tactic\Domain\Exception;

use Alejgarciarodriguez\PccBasketApp\Common\Domain\Exception;

class TacticNotFound extends Exception
{
    public function __construct($message = "This tactics was not found")
    {
        parent::__construct($message);
    }
}