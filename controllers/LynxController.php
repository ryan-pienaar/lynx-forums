<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;

/**
 * Class LynxController
 *
 * @author Ryan Pienaar
 * @package app\controllers
 */
class LynxController extends Controller
{
    public function home()
    {
        $params = [
            'name' => 'Lynx Forums Software'
        ];
        return $this->render('home', $params);
    }
    public function contact()
    {
        return $this->render('contact');
    }
    public function handleContactData(Request $request)
    {
        $body = $request->getBody();
        return 'Handling submitted contact data';
    }
}