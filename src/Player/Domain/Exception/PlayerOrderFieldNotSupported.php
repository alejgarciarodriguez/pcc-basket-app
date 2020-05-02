<?php

namespace Alejgarciarodriguez\PccBasketApp\Player\Domain\Exception;

use Alejgarciarodriguez\PccBasketApp\Common\Domain\Exception;

class PlayerOrderFieldNotSupported extends Exception
{
    public function __construct($message = 'This field is not supported for ordering')
    {
        parent::__construct($message);
    }
}