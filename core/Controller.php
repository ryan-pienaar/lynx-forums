<?php

namespace app\core;

class Controller
{
    public string $layout = 'main';
    public function setLayout($layout)
    {
        $this->layout = $layout;
    }
    public function render($view, $params = [])
    {
        return Kernel::$kernel->router->renderView($view, $params);
    }
}