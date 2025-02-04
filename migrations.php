<?php
/**
 * @author Ryan Pienaar
 */

use app\controllers\SiteController;
use app\controllers\AuthController;
use ryan\lykacore\Kernel;

require_once __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$conf = [
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD']
    ]
];

$kernel = new Kernel(__DIR__, $conf);

$kernel->db->applyMigrations();