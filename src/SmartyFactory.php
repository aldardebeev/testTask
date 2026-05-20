<?php

declare(strict_types=1);

namespace App;

final class SmartyFactory
{
    /**
     * @param array{template_dir: string, compile_dir: string, cache_dir: string} $config
     */
    public static function create(array $config): \Smarty
    {
        self::ensureDirectory($config['compile_dir']);
        self::ensureDirectory($config['cache_dir']);

        $smarty = new \Smarty();
        $smarty->setTemplateDir($config['template_dir']);
        $smarty->setCompileDir($config['compile_dir']);
        $smarty->setCacheDir($config['cache_dir']);

        return $smarty;
    }

    private static function ensureDirectory(string $path): void
    {
        if (!is_dir($path)) {
            mkdir($path, 0755, true);
        }
    }
}
