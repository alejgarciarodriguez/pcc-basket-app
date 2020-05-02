<?php

namespace Alejgarciarodriguez\PccBasketApp\Tactic\Domain;

interface Tactic
{
    public function aliases(): array;

    public function requirements(): array;

    public function supports(array $array): bool;
}