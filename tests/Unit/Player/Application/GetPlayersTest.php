<?php

namespace Alejgarciarodriguez\PccBasketApp\Tests\Unit\Player\Application;

use Alejgarciarodriguez\PccBasketApp\Player\Application\Get\GetPlayersQuery;
use Alejgarciarodriguez\PccBasketApp\Player\Application\Get\GetPlayersQueryHandler;
use Alejgarciarodriguez\PccBasketApp\Player\Domain\Player;
use Alejgarciarodriguez\PccBasketApp\Player\Domain\PlayerRepository;
use Alejgarciarodriguez\PccBasketApp\Player\PlayerOrder;
use Alejgarciarodriguez\PccBasketApp\Tests\Unit\Common\TestCase;

class GetPlayersTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     */
    public function testListOrder(?string $field, ?string $dir, array $input, array $result): void
    {
        $query = new GetPlayersQuery(new PlayerOrder($field, $dir));
        $repository = $this->createMock(PlayerRepository::class);
        $repository->expects($this->once())->method('findAll')->willReturn($input);
        $handler = new GetPlayersQueryHandler($repository);
        $response = $handler->__invoke($query);
        $this->assertEquals($result, $response->getTeam());
    }

    public function dataProvider(): array
    {
        return [
            [null, null, $this->numberInput(), $this->numberAscExpectedOutput()],
            ['number', 'asc', $this->numberInput(), $this->numberAscExpectedOutput()],
            ['number', 'desc', $this->numberInput(), $this->numberDescExpectedOutput()],
            ['valuation', 'asc', $this->valuationInput(), $this->valuationAscExpectedOutput()],
            ['valuation', 'desc', $this->valuationInput(), $this->valuationDescExpectedOutput()],
        ];
    }

    private function numberInput(): array
    {
        return [
            Player::fromArray([
                'number' => 2,
                'name' => 'Felipe Reyes',
                'role' => 'PIVOT',
                'valuation' => 1
            ]),
            Player::fromArray([
                'number' => 1,
                'name' => 'Felipe Reyes',
                'role' => 'PIVOT',
                'valuation' => 1
            ]),
        ];
    }

    private function valuationInput(): array
    {
        return [
            Player::fromArray([
                'number' => 1,
                'name' => 'Felipe Reyes',
                'role' => 'PIVOT',
                'valuation' => 1
            ]),
            Player::fromArray([
                'number' => 1,
                'name' => 'Felipe Reyes',
                'role' => 'PIVOT',
                'valuation' => 2
            ]),
        ];
    }

    private function numberAscExpectedOutput(): array
    {
        return [
            Player::fromArray([
                'number' => 1,
                'name' => 'Felipe Reyes',
                'role' => 'PIVOT',
                'valuation' => 1
            ]),
            Player::fromArray([
                'number' => 2,
                'name' => 'Felipe Reyes',
                'role' => 'PIVOT',
                'valuation' => 1
            ]),
        ];
    }

    private function numberDescExpectedOutput(): array
    {
        return [
            Player::fromArray([
                'number' => 2,
                'name' => 'Felipe Reyes',
                'role' => 'PIVOT',
                'valuation' => 1
            ]),
            Player::fromArray([
                'number' => 1,
                'name' => 'Felipe Reyes',
                'role' => 'PIVOT',
                'valuation' => 1
            ]),
        ];
    }

    private function valuationAscExpectedOutput(): array
    {
        return [
            Player::fromArray([
                'number' => 1,
                'name' => 'Felipe Reyes',
                'role' => 'PIVOT',
                'valuation' => 1
            ]),
            Player::fromArray([
                'number' => 1,
                'name' => 'Felipe Reyes',
                'role' => 'PIVOT',
                'valuation' => 2
            ]),
        ];
    }

    private function valuationDescExpectedOutput(): array
    {
        return [
            Player::fromArray([
                'number' => 1,
                'name' => 'Felipe Reyes',
                'role' => 'PIVOT',
                'valuation' => 2
            ]),
            Player::fromArray([
                'number' => 1,
                'name' => 'Felipe Reyes',
                'role' => 'PIVOT',
                'valuation' => 1
            ]),
        ];
    }
}