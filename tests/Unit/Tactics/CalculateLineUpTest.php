<?php

namespace Alejgarciarodriguez\PccBasketApp\Tests\Unit\Tactics;

use Alejgarciarodriguez\PccBasketApp\Player\Domain\Player;
use Alejgarciarodriguez\PccBasketApp\Player\Domain\PlayerRepository;
use Alejgarciarodriguez\PccBasketApp\Tactic\Application\CalculateLineUpCommandHandler;
use Alejgarciarodriguez\PccBasketApp\Tactic\Application\CalculateLineUpQuery;
use Alejgarciarodriguez\PccBasketApp\Tactic\Domain\AttackTactic;
use Alejgarciarodriguez\PccBasketApp\Tactic\Domain\DefenseTactic;
use Alejgarciarodriguez\PccBasketApp\Tactic\Domain\Exception\TacticNotSupported;
use Alejgarciarodriguez\PccBasketApp\Tactic\Domain\TacticCollector;
use Alejgarciarodriguez\PccBasketApp\Tactic\Domain\TacticFinder;
use Alejgarciarodriguez\PccBasketApp\Tactic\Domain\ZoneDefenseTactic;
use Alejgarciarodriguez\PccBasketApp\Tests\Unit\Common\TestCase;

class CalculateLineUpTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     */
    public function testSupportedTactics($tactic, $players, $supported): void
    {
        if(!$supported){
            $this->expectException(TacticNotSupported::class);
        }

        $collector = new TacticCollector();
        $collector->addTactic(new AttackTactic());
        $collector->addTactic(new DefenseTactic());
        $collector->addTactic(new ZoneDefenseTactic());
        $finder = new TacticFinder($collector);
        $playerRepository = $this->createMock(PlayerRepository::class);
        $playerRepository->expects($this->once())->method('findAll')->willReturn($players);
        $handler = new CalculateLineUpCommandHandler($finder, $playerRepository);
        $handler->__invoke(new CalculateLineUpQuery($tactic));
    }

    public function dataProvider(): array
    {
        return [
            ['attack', $this->attackLineUp(), true],
            ['attack', $this->defenseLineUp(), false],
            ['ataque', $this->zoneDefenseLineUp(), false],
            ['defense', $this->attackLineUp(), false],
            ['defense', $this->defenseLineUp(), true],
            ['defensa', $this->zoneDefenseLineUp(), false],
            ['zone-defense', $this->attackLineUp(), false],
            ['defensa zonal', $this->defenseLineUp(), false],
            ['zone defense', $this->zoneDefenseLineUp(), true],
        ];
    }

    private function defenseLineUp(): array
    {
        return [
            Player::fromArray([
                'number' => 1,
                'valuation' => 50,
                'name' => 'Player',
                'role' => 'BASE'
            ]),
            Player::fromArray([
                'number' => 2,
                'valuation' => 20,
                'name' => 'Player',
                'role' => 'PIVOT'
            ]),
            Player::fromArray([
                'number' => 4,
                'valuation' => 90,
                'name' => 'Player',
                'role' => 'ESCOLTA'
            ]),
            Player::fromArray([
                'number' => 7,
                'valuation' => 90,
                'name' => 'Player',
                'role' => 'ESCOLTA'
            ]),
            Player::fromArray([
                'number' => 8,
                'valuation' => 70,
                'name' => 'Player',
                'role' => 'ALA-PIVOT'
            ]),
        ];
    }

    private function zoneDefenseLineUp(): array
    {
        return [
            Player::fromArray([
                'number' => 1,
                'valuation' => 50,
                'name' => 'Player',
                'role' => 'BASE'
            ]),
            Player::fromArray([
                'number' => 2,
                'valuation' => 20,
                'name' => 'Player',
                'role' => 'PIVOT'
            ]),
            Player::fromArray([
                'number' => 4,
                'valuation' => 90,
                'name' => 'Player',
                'role' => 'BASE'
            ]),
            Player::fromArray([
                'number' => 4,
                'valuation' => 60,
                'name' => 'Player',
                'role' => 'ALERO'
            ]),
            Player::fromArray([
                'number' => 8,
                'valuation' => 70,
                'name' => 'Player',
                'role' => 'ALA-PIVOT'
            ]),
        ];
    }

    private function attackLineUp(): array
    {
        return [
            Player::fromArray([
                'number' => 1,
                'valuation' => 50,
                'name' => 'Player',
                'role' => 'BASE'
            ]),
            Player::fromArray([
                'number' => 2,
                'valuation' => 20,
                'name' => 'Player',
                'role' => 'PIVOT'
            ]),
            Player::fromArray([
                'number' => 4,
                'valuation' => 90,
                'name' => 'Player',
                'role' => 'ALERO'
            ]),
            Player::fromArray([
                'number' => 7,
                'valuation' => 90,
                'name' => 'Player',
                'role' => 'ESCOLTA'
            ]),
            Player::fromArray([
                'number' => 8,
                'valuation' => 70,
                'name' => 'Player',
                'role' => 'ALA-PIVOT'
            ]),
        ];
    }
}