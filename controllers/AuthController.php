<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Kernel;
use app\core\Request;
use app\models\User;

class AuthController extends Controller
{
    public function register(Request $request)
    {

        $user = new User();
        if ($request->isPost()) {
            $user->loadData($request->getBody());

            if ($user->validate() && $user->save()) {
                Kernel::$kernel->response->redirect('/');
            }
            return $this->render('register', [
               'model' => $user
            ]);

        }
        $this->setLayout('auth');
        return $this->render('register', [
            'model' => $user
        ]);
    }

    public function login(Request $request)
    {
        $this->setLayout('auth');
        return $this->render('login');
    }
}