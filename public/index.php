<?php

session_start();

require_once '../src/core/Router.php';
require_once '../src/core/Database.php';

$router = new Router();
$router->route(); 