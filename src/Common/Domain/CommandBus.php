<?php

namespace Alejgarciarodriguez\PccBasketApp\Common\Domain;

interface CommandBus
{
    public function handle(Command $command);
}