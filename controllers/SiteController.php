<?php

/**
 * Class SiteController
 *
 * @package app\controllers
 * @author Ryan Pienaar <ryan@ryanpienaar.dev>
 */


namespace app\controllers;

use ryanp\lykacore\Kernel;
use ryanp\lykacore\Controller;
use ryanp\lykacore\Request;
use ryanp\lykacore\Response;
use app\models\ContactForm;

/**
 * Class SiteController
 *
 * @author Ryan Pienaar
 * @package app\controllers
 */
class SiteController extends Controller
{
    public function home()
    {
        $params = [
            'name' => 'Lynx Forums Software'
        ];
        return $this->render('home', $params);
    }
    public function contact(Request $request, Response $response)
    {
        $contact = new ContactForm();
        if ($request->isPost()) {
            $contact->loadData($request->getBody());
            if ($contact->validate() && $contact->send()) {
                Kernel::$kernel->session->setFlash('success', 'Thanks for contacting us.');
                return $response->redirect('/contact');
            }
        }
        return $this->render('contact', [
            'model' => $contact
        ]);
    }
}