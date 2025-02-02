<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;

class AuthController extends Controller
{
    public function register()
    {
        $this->setLayout('auth');
        return $this->render('register');
    }

    public function login(Request $request)
    {
        $this->setLayout('auth');
        if ($request->isPost()) {
            return 'Handle submitted data';
        }
        return $this->render('login');
    }
}