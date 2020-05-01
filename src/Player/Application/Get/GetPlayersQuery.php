<?php

namespace Alejgarciarodriguez\PccBasketApp\Player\Application\Get;

use Alejgarciarodriguez\PccBasketApp\Common\Domain\Query;

class GetPlayersQuery implements Query
{
    private $field;
    private $dir;

    public function __construct($field, $dir)
    {
        $this->field = $field;
        $this->dir = $dir;
    }

    /**
     * @return mixed
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * @return mixed
     */
    public function getDir()
    {
        return $this->dir;
    }
}