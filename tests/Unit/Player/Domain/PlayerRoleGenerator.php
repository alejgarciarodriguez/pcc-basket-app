<?php

namespace Alejgarciarodriguez\PccBasketApp\Tests\Unit\Player\Domain;

class PlayerRoleGenerator
{
    private const ROLES = [
        'BASE',
        'ESCOLTA',
        'ALERO',
        'ALA-PIVOT',
        'PIVOT'
    ];

    public static function random()
    {
        return self::ROLES[random_int(0, count(self::ROLES) - 1)];
    }
}