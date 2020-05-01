<?php

namespace Alejgarciarodriguez\PccBasketApp\Player\Domain\ValueObject;

use Alejgarciarodriguez\PccBasketApp\Player\Domain\Exception\PlayerNumberNotValid;

class PlayerNumber
{
    private $value;

    public function __construct($value)
    {
        $value = (int)$value;

        if($value <= 0){
            throw new PlayerNumberNotValid();
        }

        $this->value = $value;
    }

    /**
     * @return int
     */
    public function getValue(): int
    {
        return $this->value;
    }
}