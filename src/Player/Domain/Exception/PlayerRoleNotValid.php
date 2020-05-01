<?php

namespace Alejgarciarodriguez\PccBasketApp\Player\Domain\Exception;

use Alejgarciarodriguez\PccBasketApp\Common\Domain\Exception;

class PlayerRoleNotValid extends Exception
{
    public function __construct($message = "This role is not valid")
    {
        parent::__construct($message);
    }
}