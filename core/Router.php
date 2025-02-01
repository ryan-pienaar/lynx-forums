<?php
/**
 * Description of Router
 *
 * @author Ryan Pienaar
 * @package app\core
 */

namespace app\core;

class Router {
    protected array $routes = [];
    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }
    
    public function resolve()
    {
        
    }
}
