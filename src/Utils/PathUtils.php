<?php

namespace Fux\Cli\Utils;

class PathUtils
{

    /**
     * Returns the path of the project's root (the folder where "vendor" folder is placed)
    */
    public static function getProjectRoot(): string
    {
        $reflection = new \ReflectionClass(\Composer\Autoload\ClassLoader::class);
        return dirname($reflection->getFileName(), 3);
    }

}