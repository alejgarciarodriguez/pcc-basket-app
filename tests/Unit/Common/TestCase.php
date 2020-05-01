<?php

namespace Alejgarciarodriguez\PccBasketApp\Tests\Unit\Common;

use Faker\Factory;

class TestCase extends \PHPUnit\Framework\TestCase
{
    protected static $faker;

    public static function setUpBeforeClass()
    {
        self::$faker = Factory::create();
    }

    public static function tearDownAfterClass()
    {
        self::$faker = null;
    }

    protected function getFaker()
    {
        return self::$faker;
    }
}