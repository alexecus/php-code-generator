<?php

namespace Alexecus\Spawner\Operations;

use Symfony\Component\Filesystem\Filesystem;

use Alexecus\Spawner\Path;

class Append
{
    /**
     * @var Filesystem
     */
    private $filesystem;

    /**
     * @var Path
     */
    private $path;

    public function __construct(Filesystem $filesystem, Path $path)
    {
        $this->filesystem = $filesystem;
        $this->path = $path;
    }
 
    /**
     * Performs the append operation
     *
     * @param string $target The file path
     */
    public function perform($target, $text, $pattern, $replacements = [])
    {
        $body = file_get_contents($target);

        $text = preg_replace_callback('/\{(.*?)\}/', function ($matches) use ($replacements) {
            list($string, $match) = $matches;

            return $replacements[$match] ?? $string;
        }, $text);

        $replacement = preg_replace_callback($pattern, function ($matches) use ($text) {
            list($string, $match) = $matches;

            $replacer = $match . $text;

            return str_replace($match, $replacer, $string);
        }, $body);

        if ($replacement) {
            file_put_contents($target, $replacement);
        }
    }
}
