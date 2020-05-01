<?php

namespace Alejgarciarodriguez\PccBasketApp\Common\Domain;

interface EventBus
{
    public function handle(Event $event);
}