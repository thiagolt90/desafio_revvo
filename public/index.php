<?php

session_start();

spl_autoload_register(function ($class_name) {
    // Controllers: HomeController.php → src/controllers/HomeController.php
    $controllerFile = __DIR__ . '/../src/controllers/' . $class_name . '.php';
    if (file_exists($controllerFile)) {
        require_once $controllerFile;
        return;
    }
    
    // Models: CourseModel.php → src/models/CourseModel.php
    $modelFile = __DIR__ . '/../src/models/' . $class_name . '.php';
    if (file_exists($modelFile)) {
        require_once $modelFile;
        return;
    }
    
    // Core: Router.php, Database.php
    $coreFile = __DIR__ . '/../src/core/' . $class_name . '.php';
    if (file_exists($coreFile)) {
        require_once $coreFile;
        return;
    }
});

require_once '../src/core/Router.php';
require_once '../src/core/Database.php';

$router = new Router();
$router->route(); 