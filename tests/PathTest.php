<?php

namespace Alexecus\Spawner\Tests;

use Alexecus\Spawner\Path;

use PHPUnit\Framework\TestCase;

class PathTest extends TestCase
{
    public function testSetRoot()
    {
        $path = new Path();
        $path->setRoot('/var/www/html');

        $this->assertEquals('/var/www/html', $path->getRoot());

        $path->setRoot('/var/www/html/');

        $this->assertEquals('/var/www/html', $path->getRoot());
    }

    public function testAbsolute()
    {
        $path = new Path();
        $path->setRoot('/var/www/html');

        $absolute = $path->absolute('example/path');

        $this->assertEquals('/var/www/html/example/path', $absolute);

        $absolute = $path->absolute('example/path/');

        $this->assertEquals('/var/www/html/example/path', $absolute);

        $absolute = $path->absolute('/example/path/');

        $this->assertEquals('/var/www/html/example/path', $absolute);
    }
}
