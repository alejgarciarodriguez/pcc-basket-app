<?php

namespace Alejgarciarodriguez\PccBasketApp\Player\Domain\Exception;

use Alejgarciarodriguez\PccBasketApp\Common\Domain\Exception;

class PlayerNameNotValid extends Exception
{
    public function __construct($message = "Player name is not valid")
    {
        parent::__construct($message);
    }
}