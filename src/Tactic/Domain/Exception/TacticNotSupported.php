<?php

namespace Alejgarciarodriguez\PccBasketApp\Tactic\Domain\Exception;

use Alejgarciarodriguez\PccBasketApp\Common\Domain\Exception;

class TacticNotSupported extends Exception
{
    public function __construct($message = "Not enough players for this tactic")
    {
        parent::__construct($message);
    }
}