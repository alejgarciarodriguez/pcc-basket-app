<?php

namespace Alejgarciarodriguez\PccBasketApp\Player\Domain;

final class OrderDir
{
    private const dirs = ['asc', 'desc'];

    public function __construct($value = 'asc')
    {
        if(in_array(strtolower($value), self::dirs, true)){
            $this->value = $value;
        } else {
            $this->value = 'asc'; // default value
        }
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }
}