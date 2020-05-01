<?php

namespace Alejgarciarodriguez\PccBasketApp\Player\Domain\Exception;

use Alejgarciarodriguez\PccBasketApp\Common\Domain\Exception;

class PlayerNumberNotValid extends Exception
{
    public function __construct($message = "Player number must be an integer greater than 0")
    {
        parent::__construct($message);
    }
}