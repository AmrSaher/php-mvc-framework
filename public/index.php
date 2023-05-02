<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\App;
use App\Config;
use App\Router;

// Controllers
use App\Controllers\HomeController;

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

define('STORAGE_PATH', __DIR__ . '/../storage');
define('VIEWS_PATH', __DIR__ . '/../views');

$router = new Router();

$router
    ->get('/', [HomeController::class, 'index']);

(new App(
    $router,
    ['uri' => $_SERVER['REQUEST_URI'], 'method' => $_SERVER['REQUEST_METHOD']],
    new Config($_ENV)
))->run();