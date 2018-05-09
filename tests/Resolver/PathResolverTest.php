<?php

namespace Alexecus\Spawner\Tests\Resolver;

use Alexecus\Spawner\Resolver\PathResolver;

use PHPUnit\Framework\TestCase;

class PathResolverTest extends TestCase
{
    public function testSetRoot()
    {
        $path = new PathResolver();
        $path->setRoot('/var/www/html');

        $this->assertEquals('/var/www/html', $path->getRoot());

        $path->setRoot('/var/www/html/');

        $this->assertEquals('/var/www/html', $path->getRoot());
    }

    public function testAbsolute()
    {
        $path = new PathResolver();
        $path->setRoot('/var/www/html');

        $absolute = $path->absolute('example/path');

        $this->assertEquals('/var/www/html/example/path', $absolute);

        $absolute = $path->absolute('example/path/');

        $this->assertEquals('/var/www/html/example/path', $absolute);

        $absolute = $path->absolute('/example/path/');

        $this->assertEquals('/var/www/html/example/path', $absolute);
    }
}
