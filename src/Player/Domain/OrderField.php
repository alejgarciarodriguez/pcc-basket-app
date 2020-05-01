<?php

namespace Alejgarciarodriguez\PccBasketApp\Player\Domain;

final class OrderField
{
    private const fields = ['number', 'valuation']; // fields allowed for ordering

    public function __construct($value = 'number')
    {
        if(in_array(strtolower($value), self::fields, true)){
            $this->value = $value;
        } else {
            $this->value = 'number'; // default value
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