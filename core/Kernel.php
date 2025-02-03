<?php
/**
 * Description of Kernel
 *
 * @author Ryan Pienaar
 * @package app\core
 */

namespace app\core;

class Kernel {

    public static string $ROOT_DIR;
    public Router $router;
    public Request $request;
    public Response $response;
    public Session $session;
    public Database $db;
    public static Kernel $kernel;
    public Controller $controller;
    public function __construct($rootPath, array $conf)
    {
        self::$ROOT_DIR = $rootPath;
        self::$kernel = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->session = new Session();
        $this->router = new Router($this->request, $this->response);

        $this->db = new Database($conf['db']);
    }
    
    public function run() {
        echo $this->router->resolve();
    }

    public function setController(Controller $controller): void
    {
        $this->controller = $controller;
    }

    public function getController(): Controller
    {
        return $this->controller;
    }
}