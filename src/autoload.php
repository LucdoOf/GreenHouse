<?php
spl_autoload_register(function ($class) {

    // Préfixe des classes du projet
    $prefix = 'GreenHouse\\';

    // Répertoire des sources
    $base_dir = APPLICATION_PATH . '/src/';

    // Si la classe commence par le préfixe
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }

    // On récupère le nom de la classe sans le préfixe
    $relative_class = substr($class, $len);

    // Puis le fichier de la classe
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    // Et si le fichier existe, on l'inclus
    if (file_exists($file)) {
        require $file;
    }
});
