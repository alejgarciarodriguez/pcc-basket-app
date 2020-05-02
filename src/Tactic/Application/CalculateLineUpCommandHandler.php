<?php

namespace Alejgarciarodriguez\PccBasketApp\Tactic\Application;

use Alejgarciarodriguez\PccBasketApp\Common\Domain\QueryHandler;
use Alejgarciarodriguez\PccBasketApp\Player\Domain\Player;
use Alejgarciarodriguez\PccBasketApp\Player\Domain\PlayerRepository;
use Alejgarciarodriguez\PccBasketApp\Tactic\Domain\CalculateLineUpResponse;
use Alejgarciarodriguez\PccBasketApp\Tactic\Domain\Exception\TacticNotSupported;
use Alejgarciarodriguez\PccBasketApp\Tactic\Domain\TacticFinder;

class CalculateLineUpCommandHandler implements QueryHandler
{
    private $tacticsFinder;
    private $playerRepository;

    public function __construct(TacticFinder $tacticsFinder, PlayerRepository $playerRepository)
    {
        $this->tacticsFinder = $tacticsFinder;
        $this->playerRepository = $playerRepository;
    }

    public function __invoke(CalculateLineUpQuery $command)
    {
        $tactics = $this->tacticsFinder->__invoke($command->getTactics());

        $players = $this->playerRepository->findAll();

        $playersGroupedByRole = [];

        foreach($players as $player) {
            $role = $player->getRole()->getValue();
            $playersGroupedByRole[$role][] = $player;
        }

        $supports = $tactics->supports($playersGroupedByRole);

        if(!$supports){
            throw new TacticNotSupported();
        }

        // order by valuation

        foreach($playersGroupedByRole as $role => &$playersByRole){
            uasort($playersByRole, static function(Player $a, Player $b){
                if ($a->getValuation()->getValue() === $b->getValuation()->getValue()){
                    return 0;
                }
                return ($a < $b) ? 1 :-1;
            });
        }
        unset($playersByRole);

        $lineUp = [];

        foreach($tactics->requirements() as $role => $requirementNumber){
            if(array_key_exists($role, $playersGroupedByRole)){
                // take N requires players for each role if exists
                $chosenByValuation = array_slice($playersGroupedByRole[$role], 0, $requirementNumber);
                foreach($chosenByValuation as $player){
                    $lineUp[] = $player;
                }
            }
        }

        return new CalculateLineUpResponse($lineUp);
    }
}