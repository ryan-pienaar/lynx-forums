<?php

/**
 * Class AuthController
 *
 * @package app\controllers
 * @author Ryan Pienaar <ryan@ryanpienaar.dev>
 */

namespace app\controllers;

use ryanp\lykacore\Controller;
use ryanp\lykacore\Kernel;
use ryanp\lykacore\middleware\AuthGate;
use ryanp\lykacore\Request;
use ryanp\lykacore\Response;
use app\models\LoginForm;
use app\models\User;

class AuthController extends Controller
{
    public function __construct()
    {
        //Middleware
        $this->registerGate(new AuthGate(['profile']));
    }
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

    public function logout(Request $request, Response $response)
    {
        Kernel::$kernel->logout();
        $response->redirect('/');
    }

    public function profile()
    {
        return $this->render('profile');
    }

}