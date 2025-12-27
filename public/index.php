<?php

session_start();

$config = require_once __DIR__ . '/../src/config/app.php';
define('BASE_URL', $config['base_url']);
define('APP_NAME', $config['app_name']);

spl_autoload_register(function ($class_name) {
    $controllerFile = __DIR__ . '/../src/controllers/' . $class_name . '.php';
    if (file_exists($controllerFile)) {
        require_once $controllerFile;
        return;
    }
    
    $modelFile = __DIR__ . '/../src/models/' . $class_name . '.php';
    if (file_exists($modelFile)) {
        require_once $modelFile;
        return;
    }
    
    $coreFile = __DIR__ . '/../src/core/' . $class_name . '.php';
    if (file_exists($coreFile)) {
        require_once $coreFile;
        return;
    }
});

require_once __DIR__ . '/../src/core/helpers.php';

$router = new Router();
$router->route(); 