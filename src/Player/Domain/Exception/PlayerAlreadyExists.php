<?php

namespace Alejgarciarodriguez\PccBasketApp\Player\Domain\Exception;

use Alejgarciarodriguez\PccBasketApp\Common\Domain\Exception;

class PlayerAlreadyExists extends Exception
{
    public function __construct($message = "A player with this number already exists")
    {
        parent::__construct($message);
    }
}