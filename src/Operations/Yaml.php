<?php

namespace Alexecus\Spawner\Operations;

use Exception;
use Symfony\Component\Yaml\Yaml as Parser;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Yaml\Exception\ParseException;

use Alexecus\Spawner\Resolver\PathResource;

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
            $path = $target->getAbsolute();

            if (file_exists($path)) {
                $body = file_get_contents($path);
                $data = Parser::parse($body);
            }
        } catch (ParseException $e) {
            // handle invalid YAML scenario here
            throw $e;
        } catch (Exception $e) {
            // do nothing
        }

        $data = array_replace_recursive($data, $append);
        $yaml = Parser::dump($data, 2, $spaces);

        $this->filesystem->dumpFile($target->getAbsolute(), $yaml);
    }
}
