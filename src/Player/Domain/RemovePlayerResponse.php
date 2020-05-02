<?php

namespace Alejgarciarodriguez\PccBasketApp\Player\Domain;

class RemovePlayerResponse implements \JsonSerializable
{
    private $number;

    public function __construct(int $number)
    {
        $this->number = $number;
    }

    public function jsonSerialize()
    {
        return [
            'status' => 'success',
            'message' => sprintf('Player with number \'%d\' was removed', $this->number)
        ];
    }

    public function __toString()
    {
        return (string)json_encode($this->jsonSerialize());
    }
}