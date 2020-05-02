<?php

namespace Alejgarciarodriguez\PccBasketApp\Tests\Functional\Player;

use Alejgarciarodriguez\PccBasketApp\Cli\PccBasketAppCliKernel;
use Alejgarciarodriguez\PccBasketApp\Cli\Player\CreatePlayerCliCommand;
use Alejgarciarodriguez\PccBasketApp\Tests\Functional\Common\CliTestCase;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Console\Tester\CommandTester;

class CreatePlayerTest extends CliTestCase
{
    public function testPlayerIsCreated(): void
    {
        $application = new Application(self::$kernel);
        $command = new CreatePlayerCliCommand(self::$container->get('command.bus'));
        $application->add($command);
        $commandTester = new CommandTester($command);
        $commandTester->execute([
            '--number' => 9,
            '--name' => 'Felipe Reyes',
            '--role' => 'PIVOT',
            '--valuation' => 100
        ]);
        $this->assertEquals(0, $commandTester->getStatusCode());
    }

    public function testPlayerIsNotCreatedIfExists(): void
    {
        file_put_contents($this->getFile(), '[{"number":9,"name":"Felipe Reyes","role":"PIVOT","valuation":100}]');
        $application = new Application(self::$kernel);
        $command = new CreatePlayerCliCommand(self::$container->get('command.bus'));
        $application->add($command);
        $commandTester = new CommandTester($command);
        $commandTester->execute([
            '--number' => 9,
            '--name' => 'Felipe Reyes',
            '--role' => 'PIVOT',
            '--valuation' => 100
        ]);
        $this->assertNotEquals(0, $commandTester->getStatusCode());
    }
}