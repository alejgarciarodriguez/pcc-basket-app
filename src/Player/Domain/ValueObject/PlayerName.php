<?php

namespace Alejgarciarodriguez\PccBasketApp\Player\Domain\ValueObject;

use Alejgarciarodriguez\PccBasketApp\Player\Domain\Exception\PlayerNameNotValid;

final class PlayerName
{
    public function __construct(?string $value)
    {
        if(null === $value){
            throw new PlayerNameNotValid();
        }

        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getValue(): ?string
    {
        return $this->value;
    }
}