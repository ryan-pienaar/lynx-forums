<?php

namespace app\controllers;

use app\core\Application;

/**
 * Class LynxController
 *
 * @author Ryan Pienaar
 * @package app\controllers
 */
class LynxController
{
    public static function home()
    {
        $params = [
            'name' => 'Lynx Forums Software'
        ];
        return Application::$app->router->renderView('home', $params);
    }
    public static function contact()
    {
        return Application::$app->router->renderView('contact');
    }
    public static function handleContactData(): string
    {
        return 'Handling submitted contact data';
    }
}