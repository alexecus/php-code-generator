<?php

namespace Alexecus\Spawner\Operations;

class Append extends AbstractOperation
{
    /**
     * Performs the append operation
     *
     * @param string $target The file path
     */
    public function perform($target, $text, $pattern)
    {
        $body = file_get_contents($target);

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
