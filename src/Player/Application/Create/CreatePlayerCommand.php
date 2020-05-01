<?php

namespace Alejgarciarodriguez\PccBasketApp\Player\Application\Create;

use Alejgarciarodriguez\PccBasketApp\Common\Domain\Command;

class CreatePlayerCommand implements Command
{
    private $number;
    private $name;
    private $role;
    private $valuation;

    public function __construct($number, $name, $role, $valuation)
    {
        $this->number = $number;
        $this->name = $name;
        $this->role = $role;
        $this->valuation = $valuation;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @return mixed
     */
    public function getValuation()
    {
        return $this->valuation;
    }
}