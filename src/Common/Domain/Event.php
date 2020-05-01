<?php

namespace Alejgarciarodriguez\PccBasketApp\Common\Domain;

interface Event
{
    public function getTimestamp(): \DateTimeImmutable;
}