<?php

namespace App\Containers\Snippets\Utils;

/**
 *
 */
class SnippetUtil
{
    /**
     * @return string
     */
    public static function getBasePath(): string
    {
        return base_path(config('project.snippets.path')) . '/';
    }

    /**
     * @param string $componentName
     * @return string
     */
    public static function getFullPath(string $componentName): string
    {
        return self::getBasePath() . $componentName . config('project.snippets.extension');
    }

    /**
     * @param string $componentName
     * @return string
     */
    public static function getContent(string $componentName): string
    {
        $path = self::getFullPath($componentName);
        return file_exists($path) ? file_get_contents($path) : '';
    }
}
