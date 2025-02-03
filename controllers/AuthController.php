<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Kernel;
use app\core\Request;
use app\core\Response;
use app\models\LoginForm;
use app\models\User;

class AuthController extends Controller
{
    public function register(Request $request ,Response $response)
    {

        $user = new User();
        if ($request->isPost()) {
            $user->loadData($request->getBody());

            if ($user->validate() && $user->save()) {
                Kernel::$kernel->session->setFlash('success', 'Thanks for registering!');
                $response->redirect('/');
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

    public function login(Request $request, Response $response)
    {
        $loginForm = new LoginForm();
        if ($request->isPost()) {
            $loginForm->loadData($request->getBody());

            if ($loginForm->validate() && $loginForm->login()) {
                //Kernel::$kernel->session->setFlash('success', 'Thanks for logging in!');
                $response->redirect('/');
            }
        }
        $this->setLayout('auth');
        return $this->render('login', [
            'model' => $loginForm
        ]);
    }
}