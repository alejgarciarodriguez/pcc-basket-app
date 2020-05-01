<?php

namespace Alejgarciarodriguez\PccBasketApp\Player\Application\Remove;

use Alejgarciarodriguez\PccBasketApp\Common\Domain\Command;

class RemovePlayerCommand implements Command
{
    private $number;

    public function __construct($number)
    {
        $this->number = $number;
    }

    public function getNumber()
    {
        return $this->number;
    }
}