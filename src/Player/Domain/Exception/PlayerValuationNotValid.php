<?php

namespace Alejgarciarodriguez\PccBasketApp\Player\Domain\Exception;

use Alejgarciarodriguez\PccBasketApp\Common\Domain\Exception;

class PlayerValuationNotValid extends Exception
{
    public function __construct($message = "Valuation must be an integer between 0 and 100")
    {
        parent::__construct($message);
    }
}