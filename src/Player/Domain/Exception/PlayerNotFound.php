<?php

namespace Alejgarciarodriguez\PccBasketApp\Player\Domain\Exception;

use Alejgarciarodriguez\PccBasketApp\Common\Domain\Exception;

class PlayerNotFound extends Exception
{
    public function __construct($message = "Player not found")
    {
        parent::__construct($message);
    }
}