<?php

namespace Alejgarciarodriguez\PccBasketApp\Tests\Unit\Tactic;

use Alejgarciarodriguez\PccBasketApp\Player\Domain\Player;
use Alejgarciarodriguez\PccBasketApp\Player\Domain\PlayerRepository;
use Alejgarciarodriguez\PccBasketApp\Tactic\Application\CalculateLineUpQueryHandler;
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
        $handler = new CalculateLineUpQueryHandler($finder, $playerRepository);
        $handler->__invoke(new CalculateLineUpQuery($tactic));
    }

    public function testOrderValuation(): void
    {
        $players = [
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
                'role' => 'BASE'
            ]),
            Player::fromArray([
                'number' => 4,
                'valuation' => 90,
                'name' => 'Player',
                'role' => 'BASE'
            ]),
            Player::fromArray([
                'number' => 7,
                'valuation' => 70,
                'name' => 'Player',
                'role' => 'BASE'
            ]),
            Player::fromArray([
                'number' => 8,
                'valuation' => 30,
                'name' => 'Player',
                'role' => 'ALA-PIVOT'
            ]),
            Player::fromArray([
                'number' => 8,
                'valuation' => 40,
                'name' => 'Player',
                'role' => 'ALA-PIVOT'
            ]),
            Player::fromArray([
                'number' => 8,
                'valuation' => 50,
                'name' => 'Player',
                'role' => 'PIVOT'
            ]),
            Player::fromArray([
                'number' => 8,
                'valuation' => 80,
                'name' => 'Player',
                'role' => 'PIVOT'
            ]),
            Player::fromArray([
                'number' => 8,
                'valuation' => 10,
                'name' => 'Player',
                'role' => 'ALERO'
            ]),
            Player::fromArray([
                'number' => 8,
                'valuation' => 20,
                'name' => 'Player',
                'role' => 'ALERO'
            ]),
        ];
        $collector = new TacticCollector();
        $collector->addTactic(new ZoneDefenseTactic());
        $finder = new TacticFinder($collector);
        $playerRepository = $this->createMock(PlayerRepository::class);
        $playerRepository->expects($this->once())->method('findAll')->willReturn($players);
        $handler = new CalculateLineUpQueryHandler($finder, $playerRepository);
        $response = $handler->__invoke(new CalculateLineUpQuery('zone-defense'));
        /** @var Player[] $lineUp */
        $lineUp = $response->getLineUp();

        $filterRoles = static function($role){
            return static function(Player $p) use($role){
                return $p->getRole()->getValue() === $role;
            };
        };

        $bases = array_filter($lineUp, $filterRoles('BASE'));
        $this->assertEquals(90, array_slice($bases, 0, 1)[0]->getValuation()->getValue());
        $this->assertEquals(70, array_slice($bases, 1, 1)[0]->getValuation()->getValue());

        $alero = array_filter($lineUp, $filterRoles('ALERO'));
        $this->assertEquals(20, array_slice($alero, 0, 1)[0]->getValuation()->getValue());

        $pivot = array_filter($lineUp, $filterRoles('PIVOT'));
        $this->assertEquals(80, array_slice($pivot, 0, 1)[0]->getValuation()->getValue());

        $alaPivot = $alero = array_filter($lineUp, $filterRoles('ALA-PIVOT'));
        $this->assertEquals(40, array_slice($alaPivot, 0, 1)[0]->getValuation()->getValue());
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
            ['defensa-zonal', $this->defenseLineUp(), false],
            ['zone-defense', $this->zoneDefenseLineUp(), true],
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