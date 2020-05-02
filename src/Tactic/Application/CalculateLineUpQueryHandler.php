<?php

namespace Alejgarciarodriguez\PccBasketApp\Tactic\Application;

use Alejgarciarodriguez\PccBasketApp\Common\Domain\QueryHandler;
use Alejgarciarodriguez\PccBasketApp\Player\Domain\PlayerRepository;
use Alejgarciarodriguez\PccBasketApp\Player\PlayerOrder;
use Alejgarciarodriguez\PccBasketApp\Tactic\Domain\CalculateLineUpResponse;
use Alejgarciarodriguez\PccBasketApp\Tactic\Domain\Exception\TacticNotSupported;
use Alejgarciarodriguez\PccBasketApp\Tactic\Domain\TacticFinder;

class CalculateLineUpQueryHandler implements QueryHandler
{
    private $tacticFinder;
    private $playerRepository;

    public function __construct(TacticFinder $tacticsFinder, PlayerRepository $playerRepository)
    {
        $this->tacticFinder = $tacticsFinder;
        $this->playerRepository = $playerRepository;
    }

    public function __invoke(CalculateLineUpQuery $command)
    {
        $tactics = $this->tacticFinder->__invoke($command->getTactic());

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
        $orderByEvaluation = (new PlayerOrder('valuation', 'desc'))->callback();
        foreach($playersGroupedByRole as $role => &$playersByRole){
            usort($playersByRole, $orderByEvaluation);
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