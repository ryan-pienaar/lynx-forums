<?php
/**
 * Description of Application
 *
 * @author Ryan Pienaar
 * @package app\core
 */

namespace app\core;

class Application {
    
    public Router $router;
    public function __construct()
    {
        $this->router = new Router();
    }
    
    public function run() {
        $this->reouter->resolve();
    }
}