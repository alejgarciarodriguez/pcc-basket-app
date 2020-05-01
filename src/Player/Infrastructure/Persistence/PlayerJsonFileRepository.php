<?php

namespace Alejgarciarodriguez\PccBasketApp\Player\Infrastructure\Persistence;

use Alejgarciarodriguez\PccBasketApp\Player\Domain\Player;
use Alejgarciarodriguez\PccBasketApp\Player\Domain\PlayerRepository;
use Alejgarciarodriguez\PccBasketApp\Player\Domain\ValueObject\PlayerNumber;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class PlayerJsonFileRepository implements PlayerRepository
{
    private $parameterBag;
    
    public function __construct(ParameterBagInterface $parameterBag)
    {
        $this->parameterBag = $parameterBag;
    }

    public function save(Player $player): void
    {
        $this->createFileIfNotExists();

        $team = json_decode(file_get_contents($this->getFile()), true);

        $team[] = $player;

        file_put_contents($this->getFile(), json_encode($team));
    }

    public function remove(PlayerNumber $playerNumber): void
    {
        $this->createFileIfNotExists();

        $team = json_decode(file_get_contents($this->getFile()), true);

        $newTeam = [];
        foreach($team as $playerArray){
            if($playerArray['number'] !== $playerNumber->getValue()){
                $newTeam[] = $playerArray;
            }
        }

        file_put_contents($this->getFile(), json_encode($newTeam));
    }

    public function find(PlayerNumber $playerNumber): ?Player
    {
        $this->createFileIfNotExists();

        $team = json_decode(file_get_contents($this->getFile()), true);

        foreach($team as $playerArray){
            if($playerArray['number'] === $playerNumber->getValue()){
                return Player::fromArray($playerArray);
            }
        }

        return null;
    }

    public function findAll(): array
    {
        $this->createFileIfNotExists();

        $teamArray = json_decode(file_get_contents($this->getFile()), true);

        $team = [];
        foreach($teamArray as $playerArray){
            $team[] = Player::fromArray($playerArray);
        }

        return $team;
    }

    private function createFileIfNotExists(): void
    {
        $file = $this->getFile();
        if(!file_exists($file)){
            file_put_contents($file, '[]');
        }
    }
    
    private function getFile(): string
    {
        return $this->parameterBag->get('kernel.project_dir') . '/../../players.json';
    }
}