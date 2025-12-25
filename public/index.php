<?php

use Mini\Core\Router;

require_once __DIR__ . '/../vendor/autoload.php';

// Gestion des fichiers statiques lors de l'utilisation du serveur PHP intégré
if (php_sapi_name() === 'cli-server') {
    $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $file = __DIR__ . $path;

    if ($path !== '/' && is_file($file)) {
        return false; // laisse PHP servir le fichier (logo, css, etc.)
    }
}

// On démarre la session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// On crée le routeur et on lui délègue la requête
$router = new Router();

$method = $_SERVER['REQUEST_METHOD'];
$uri    = $_SERVER['REQUEST_URI'];

$router->dispatch($method, $uri);
