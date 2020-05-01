<?php

namespace Alejgarciarodriguez\PccBasketApp\Player\Domain\ValueObject;

use Alejgarciarodriguez\PccBasketApp\Player\Domain\Exception\PlayerRoleNotValid;

final class PlayerRole
{
    private const ROLES = [
        'BASE',
        'ESCOLTA',
        'ALERO',
        'ALA-PIVOT',
        'PIVOT'
    ];

    /**
     * @var string
     */
    private $value;

    public function __construct(?string $value)
    {
        if(!in_array($value, self::ROLES, true)){
            throw new PlayerRoleNotValid();
        }

        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}