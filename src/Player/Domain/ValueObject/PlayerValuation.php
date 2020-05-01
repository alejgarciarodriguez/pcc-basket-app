<?php

namespace Alejgarciarodriguez\PccBasketApp\Player\Domain\ValueObject;

use Alejgarciarodriguez\PccBasketApp\Player\Domain\Exception\PlayerValuationNotValid;

final class PlayerValuation
{
    private $value;

    public function __construct($value)
    {
        $value = (int)$value;

        if($value < 0 || $value > 100){
            throw new PlayerValuationNotValid();
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