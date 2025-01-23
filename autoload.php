<?php
spl_autoload_register(function ($className) {
    
    $className = str_replace('\\', DIRECTORY_SEPARATOR, $className);


    $directories = [
        'classes/database/',
        'classes/user/',
        'classes/course/',
        'classes/utils',
    ];

   
    foreach ($directories as $directory) {
        $filePath = __DIR__ . '/' . $directory . $className . '.php';

    
        if (file_exists($filePath)) {
            require_once $filePath;
            return;
        }
    
        $fileName = basename($className) . '.php';
        $filePath = __DIR__ . '/' . $directory . $fileName;

        if (file_exists($filePath)) {
            require_once $filePath;
            return;
        }
    }
})
?>