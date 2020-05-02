<?php

namespace Alejgarciarodriguez\PccBasketApp\Tests\Functional\Player;

use Alejgarciarodriguez\PccBasketApp\Cli\Player\GetPlayersCliCommand;
use Alejgarciarodriguez\PccBasketApp\Player\Domain\Player;
use Alejgarciarodriguez\PccBasketApp\Tests\Functional\Common\CliTestCase;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class GetPlayersTest extends CliTestCase
{
    public function testListIsPrinted(): void
    {
        $player = Player::fromArray([
            'number' => 9,
            'name' => 'Felipe Reyes',
            'role' => 'PIVOT',
            'valuation' => 100
        ]);
        file_put_contents($this->getFile(), json_encode([$player->jsonSerialize()]));
        $application = new Application(self::$kernel);
        $command = new GetPlayersCliCommand(self::$container->get('query.bus'));
        $application->add($command);
        $commandTester = new CommandTester($command);
        $commandTester->execute([]);
        $output = trim($commandTester->getDisplay());
        $this->assertEquals(0, $commandTester->getStatusCode());
        $this->assertEquals(json_encode([$player->jsonSerialize()], JSON_PRETTY_PRINT), $output);
    }
}