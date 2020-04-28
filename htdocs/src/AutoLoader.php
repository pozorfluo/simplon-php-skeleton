<?php

declare(strict_types=1);

/**
 * 
 */
spl_autoload_register(function (string $class): bool {
    $file = str_replace('\\', DIRECTORY_SEPARATOR, 'src/' . $class) . '.php';
    if (file_exists($file)) {
        require $file;
        return true;
    }
    return false;
});
