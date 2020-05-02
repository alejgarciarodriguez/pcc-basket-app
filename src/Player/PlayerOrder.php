<?php

namespace Alejgarciarodriguez\PccBasketApp\Player;

use Alejgarciarodriguez\PccBasketApp\Player\Domain\Player;

final class PlayerOrder
{
    private const allowedFields = ['number', 'valuation'];

    private $field = 'number';
    private $dir = 'asc';

    public function __construct(?string $field, ?string $dir)
    {
        $field = strtolower($field);

        if(in_array($field, self::allowedFields, true)){
            $this->field = $field;
        }

        $dir = strtolower($dir);

        if(in_array($dir, ['asc', 'desc'])){
            $this->dir = $dir;
        }
    }

    public function callback(): callable
    {
        return function(Player $p1, Player $p2){
            $r1 = $this->propertyAccess($p1);
            $r2 = $this->propertyAccess($p2);
            if($r1 === $r2){
                return 0;
            }
            if('asc' === $this->dir){
                return ($r1 < $r2) ? -1 : 1;
            }
            return ($r1 < $r2) ? 1 : -1;
        };
    }

    // TODO: symfony property access component ?

    private function propertyAccess(Player $player)
    {
        $getter = 'get' . ucfirst($this->field);
        return $player->$getter()->getValue();
    }

    /**
     * @return string
     */
    public function getField(): string
    {
        return $this->field;
    }

    /**
     * @return string
     */
    public function getDir(): string
    {
        return $this->dir;
    }
}