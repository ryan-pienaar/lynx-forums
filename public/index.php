<?php

/**
 * @author Ryan Pienaar
 */

use app\controllers\SiteController;
use app\controllers\AuthController;
use ryanp\paprikacore\Kernel;

require_once __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$conf = [
    'userClass' => \app\models\User::class,
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD']
    ]
];

$kernel = new Kernel(dirname(__DIR__), $conf);


$kernel->router->get('/', [SiteController::class, 'home']);
$kernel->router->get('/contact', [SiteController::class, 'contact']);
$kernel->router->post('/contact', [SiteController::class, 'contact']);


//TODO - Go over these routes and make them more secure following modern MVC framework methods
$kernel->router->get('/login', [AuthController::class, 'login']);
$kernel->router->post('/login', [AuthController::class, 'login']);
$kernel->router->get('/register', [AuthController::class, 'register']);
$kernel->router->post('/register', [AuthController::class, 'register']);
$kernel->router->get('/logout', [AuthController::class, 'logout']); //TODO - Make this more secure and use POST method
$kernel->router->get('/profile', [AuthController::class, 'profile']);

$kernel->run();
