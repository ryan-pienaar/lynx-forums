<?php
/** User: Paprika...**/

require_once __DIR__ . '/../vendor/autoload.php';

use app\controllers\LynxController;
use app\controllers\AuthController;
use app\core\Application;

$app = new Application(dirname(__DIR__));


$app->router->get('/', [LynxController::class, 'home']);
$app->router->get('/contact', [LynxController::class, 'contact']);
$app->router->post('/contact', [LynxController::class, 'handleContactData']);

$app->router->get('/login', [AuthController::class, 'login']);
$app->router->post('/login', [AuthController::class, 'login']);
$app->router->get('/register', [AuthController::class, 'register']);
$app->router->post('/register', [AuthController::class, 'register']);


$app->run();
