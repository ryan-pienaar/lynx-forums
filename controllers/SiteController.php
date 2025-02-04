<?php

/**
 * Class SiteController
 *
 * @package app\controllers
 * @author Ryan Pienaar <ryan@ryanpienaar.dev>
 */


namespace app\controllers;

use ryan\lykacore\Kernel;
use ryan\lykacore\Controller;
use ryan\lykacore\Request;
use ryan\lykacore\Response;
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