<?php

namespace Alejgarciarodriguez\PccBasketApp\Tests\Functional\Player;

use Alejgarciarodriguez\PccBasketApp\Cli\PccBasketAppCliKernel;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RemovePlayerTest extends WebTestCase
{
    protected static function getKernelClass()
    {
        return PccBasketAppCliKernel::class;
    }

    protected function setUp()
    {
        static::bootKernel();
    }

    private function getFile(): string
    {
        return self::$container->getParameter('kernel.project_dir') . '/../../players.json';
    }
}