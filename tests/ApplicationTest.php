<?php

namespace Alexecus\Spawner\Tests;

use Alexecus\Spawner\Application;
use Symfony\Component\Console\Application as Console;

use PHPUnit\Framework\TestCase;

class ApplicationTest extends TestCase
{
    public function testConsoleInstances()
    {
        $name = 'Spawner';
        $version = '1.0';

        $app = new Application($name, $version);
        $console = new Console($name, $version);

        $object = $app->getConsole();

        $this->assertEquals($console, $object);
    }
}
