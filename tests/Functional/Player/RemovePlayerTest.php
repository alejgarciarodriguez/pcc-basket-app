<?php

namespace Alejgarciarodriguez\PccBasketApp\Tests\Functional\Player;

use Alejgarciarodriguez\PccBasketApp\Cli\Player\RemovePlayerCliCommand;
use Alejgarciarodriguez\PccBasketApp\Player\Domain\RemovePlayerResponse;
use Alejgarciarodriguez\PccBasketApp\Tests\Functional\Common\CliTestCase;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class RemovePlayerTest extends CliTestCase
{
    public function testPlayerIsRemoved(): void
    {
        file_put_contents($this->getFile(), '[{"number":9,"name":"Felipe Reyes","role":"PIVOT","valuation":100}]');
        $application = new Application(self::$kernel);
        $command = new RemovePlayerCliCommand(self::$container->get('command.bus'));
        $application->add($command);
        $commandTester = new CommandTester($command);
        $commandTester->execute([
            '--number' => 9,
        ]);
        $this->assertEquals(0, $commandTester->getStatusCode());
        $this->assertEquals((new RemovePlayerResponse(9)), trim($commandTester->getDisplay()));
    }

    public function testPlayerIsNotRemovedIfNotExists(): void
    {
        file_put_contents($this->getFile(), '[{"number":9,"name":"Felipe Reyes","role":"PIVOT","valuation":100}]');
        $application = new Application(self::$kernel);
        $command = new RemovePlayerCliCommand(self::$container->get('command.bus'));
        $application->add($command);
        $commandTester = new CommandTester($command);
        $commandTester->execute([
            '--number' => 10,
        ]);
        $this->assertNotEquals(0, $commandTester->getStatusCode());
        $this->assertEquals('{"status":"error","message":"Player not found"}', trim($commandTester->getDisplay()));
    }
}