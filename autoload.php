<?php
spl_autoload_register(function ($className) {
    // pour convertir le namespace en chemin de fichier
    $className = str_replace('\\', DIRECTORY_SEPARATOR, $className);

    // la définition des dossiers dans lesquels se trouvent les classe
    $directories = [
        'classes/database/',
        'classes/user/',
        'classes/course/',
        'classes/utils',
    ];

    // Parcourir les dossiers pour trouver la classe
    foreach ($directories as $directory) {
        $filePath = __DIR__ . '/' . $directory . $className . '.php';

        // si le chemin est correct
        if (file_exists($filePath)) {
            require_once $filePath;
            return;
        }
        // essai pour trouver le fichier sans stricture du namespace
        $fileName = basename($className) . '.php';
        $filePath = __DIR__ . '/' . $directory . $fileName;

        if (file_exists($filePath)) {
            require_once $filePath;
            return;
        }
    }
})
?>