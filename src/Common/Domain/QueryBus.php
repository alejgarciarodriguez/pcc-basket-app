<?php

namespace Alejgarciarodriguez\PccBasketApp\Common\Domain;

interface QueryBus
{
    public function query(Query $query): Response;
}