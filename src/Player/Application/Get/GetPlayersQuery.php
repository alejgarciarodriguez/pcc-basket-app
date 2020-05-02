<?php

namespace Alejgarciarodriguez\PccBasketApp\Player\Application\Get;

use Alejgarciarodriguez\PccBasketApp\Common\Domain\Query;
use Alejgarciarodriguez\PccBasketApp\Player\PlayerOrder;

class GetPlayersQuery implements Query
{
    private $order;

    public function __construct(PlayerOrder $playerOrder)
    {
        $this->order = $playerOrder;
    }

    public function getOrder(): PlayerOrder
    {
        return $this->order;
    }
}