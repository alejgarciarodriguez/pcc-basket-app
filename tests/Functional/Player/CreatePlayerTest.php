<?php

namespace Alejgarciarodriguez\PccBasketApp\Tests\Functional\Player;

use Alejgarciarodriguez\PccBasketApp\Cli\PccBasketAppCliKernel;
use Alejgarciarodriguez\PccBasketApp\Cli\Player\CreatePlayerUseCaseCommand;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Console\Tester\CommandTester;

class CreatePlayerTest extends WebTestCase
{
    protected static function getKernelClass()
    {
        return PccBasketAppCliKernel::class;
    }

    protected function setUp()
    {
        static::bootKernel();
    }

    private function getFile()
    {
        return self::$container->getParameter('kernel.project_dir') . '/../../players.json';
    }

    protected function tearDown(): void
    {
        $file = $this->getFile();
        if(file_exists($file)){
            unlink($file);
        }
    }

    public function testPlayerIsCreated(): void
    {
        $application = new Application(self::$kernel);
        $command = new CreatePlayerUseCaseCommand(self::$container->get('command.bus'));
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
        $command = new CreatePlayerUseCaseCommand(self::$container->get('command.bus'));
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