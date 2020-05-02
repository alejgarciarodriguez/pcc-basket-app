<?php

namespace Alejgarciarodriguez\PccBasketApp\Player\Domain;

class CreatePlayerResponse implements \JsonSerializable
{
    public function jsonSerialize(): array
    {
        return [
            'status' => 'success',
            'message' => 'Player created successfully'
        ];
    }

    public function __toString()
    {
        return (string)json_encode($this->jsonSerialize());
    }
}