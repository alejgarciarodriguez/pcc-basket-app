<?php

namespace Alejgarciarodriguez\PccBasketApp\Common\Domain;

class Exception extends \Exception implements \JsonSerializable
{
    public function __construct($message = "")
    {
        parent::__construct($message);
    }

    public function jsonSerialize()
    {
        return [
            'status' => 'error',
            'message' => $this->getMessage()
        ];
    }

    public function __toString()
    {
        return (string)json_encode($this->jsonSerialize());
    }
}