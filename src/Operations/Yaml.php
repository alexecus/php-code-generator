<?php

namespace Alexecus\Spawner\Operations;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Yaml\Yaml as Parser;

use Alexecus\Spawner\Resolver\PathResource;
use Symfony\Component\Yaml\Exception\ParseException;

class Yaml extends AbstractOperation
{
    /**
     * @var Filesystem
     */
    private $filesystem;

    public function __construct(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    /**
     * Performs the yaml operation
     */
    public function perform(PathResource $target, array $append, $spaces = 2)
    {
        $data = [];

        try {
            $data = Parser::parse($target->getAbsolute());
        } catch (ParseException $e) {
            // handle invalid YAML scenario here
            throw $e;
        }

        $data = array_replace($data, $append);
        $yaml = Yaml::dump($data, 2, $spaces);

        $this->filesystem->dumpFile($target->getAbsolute(), $yaml);
    }
}
