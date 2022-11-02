<?php

/**
 * This file loads all the class files. 
 */

namespace MMWS;

require_once 'functions.php';

/** Global functions*/

class Autoloader
{
    function getFiles($directory)
    {
        $folders = scandir($directory);
        $files = [];
        foreach ($folders as $folder) {
            if (preg_match('/(\.\.)$|(\.)$/im', $folder)) continue;
            $dir = $directory . '/' . $folder;
            if (is_dir($dir)) {
                $files = self::getFiles($dir) + $files;
            } else if (preg_match('/\.class|\.model|\.entity|\.contoller|\.trait|\.service|\.middleware|\.abstract/im', $dir, $type)) {
                $key = str_replace('.', '', $type[0]);
                $files[$key][] = $dir;
            }
        }
        return $files;
    }

    static function register()
    {
        /**
         * This loads all the classes in the src/class/  subfolders.
         * @var string[] $dir 
         */
        $coreFiles = self::getFiles(_DEFAULT_CORE_PATH_);
        $appFiles = array_merge(self::getFiles(_DEFAULT_MODULE_PATH_));
        print_r(['core' => $coreFiles, 'app' => $appFiles]);
    }
}

spl_autoload_register(function ($class) {
    $core = _DEFAULT_CORE_PATH_;
    $names = explode('\\', $class);
    $vendor = array_unshift($names);
    $filename = array_pop($names);
    $context = array_pop($names);
    $path = $core . '/' . $context . '/' . $filename  . '.php';
    require $path;
});
