<?php
/** User: Paprika...**/

require_once __DIR__ . '/../vendor/autoload.php';


use app\controllers\LynxController;
use app\core\Application;

$app = new Application(dirname(__DIR__));


$app->router->get('/', [LynxController::class, 'home']);
$app->router->get('/contact', [LynxController::class, 'contact']);
$app->router->post('/contact', [LynxController::class, 'handleContactData']);


$app->run();
