<?php

namespace Alejgarciarodriguez\PccBasketApp\Tests\Functional\Common;

use Alejgarciarodriguez\PccBasketApp\Cli\PccBasketAppCliKernel;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CliTestCase extends WebTestCase
{
    protected static function getKernelClass()
    {
        return PccBasketAppCliKernel::class;
    }

    protected function setUp()
    {
        static::bootKernel();
    }

    protected function getFile(): string
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
}