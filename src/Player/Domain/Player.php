<?php

namespace Alejgarciarodriguez\PccBasketApp\Player\Domain;

use Alejgarciarodriguez\PccBasketApp\Player\Domain\ValueObject\PlayerName;
use Alejgarciarodriguez\PccBasketApp\Player\Domain\ValueObject\PlayerNumber;
use Alejgarciarodriguez\PccBasketApp\Player\Domain\ValueObject\PlayerRole;
use Alejgarciarodriguez\PccBasketApp\Player\Domain\ValueObject\PlayerValuation;

class Player implements \JsonSerializable
{
    private $number;
    private $name;
    private $role;
    private $valuation;

    private function __construct(
        PlayerNumber $number,
        PlayerName $name,
        PlayerRole $role,
        PlayerValuation $valuation
    )
    {
        $this->number = $number;
        $this->name = $name;
        $this->role = $role;
        $this->valuation = $valuation;
    }

    public static function create(
        PlayerNumber $number,
        PlayerName $name,
        PlayerRole $role,
        PlayerValuation $valuation): self
    {
        return new self($number, $name, $role, $valuation);
    }

    /**
     * @return PlayerName
     */
    public function getName(): PlayerName
    {
        return $this->name;
    }

    /**
     * @return PlayerNumber
     */
    public function getNumber(): PlayerNumber
    {
        return $this->number;
    }

    /**
     * @return PlayerRole
     */
    public function getRole(): PlayerRole
    {
        return $this->role;
    }

    /**
     * @return PlayerValuation
     */
    public function getValuation(): PlayerValuation
    {
        return $this->valuation;
    }

    public function jsonSerialize(): array
    {
        return [
            'number' => $this->number->getValue(),
            'name' => $this->getName()->getValue(),
            'role' => $this->role->getValue(),
            'valuation' => $this->valuation->getValue(),
        ];
    }

    public static function fromArray(array $array): self
    {
        return new self(
            new PlayerNumber($array['number']),
            new PlayerName($array['name']),
            new PlayerRole($array['role']),
            new PlayerValuation($array['valuation']),
        );
    }
}