<?php

namespace FuxCli\Tests\Commands\Database;

use FuxCli\Commands\Database\Iam;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Tester\CommandTester;

class IamTest extends TestCase
{
    public function testItDoesNotCrash()
    {
        $command = new Iam();

        $tester = new CommandTester($command);
        $tester->execute(["name" => "matteo"]);
        $tester->assertCommandIsSuccessful();

        $tester->execute(["name" => "matteo-fusillo"]);
        $tester->assertCommandIsSuccessful();
    }
}