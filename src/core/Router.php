<?php

class Router {
    private $controllerName;
    private $method;
    private $params = [];
    public bool $isHome = false;

    public function __construct() {
        $this->parseUrl();
    }

    public function route() {
        $this->loadController();
        $this->callMethod();
    }

    private function parseUrl() {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            
            // SEMPRE usa nome completo do controller
            $controller = isset($url[0]) && $url[0] != '' ? ucwords($url[0]) . 'Controller' : 'HomeController';
            $this->controllerName = $controller;
            $this->method = isset($url[1]) ? $url[1] : 'index';

            unset($url[0], $url[1]);
            $this->params = array_values($url);
        } else {
            $this->isHome = true;
            $this->controllerName = 'HomeController';
            $this->method = 'index';
        }
    }

    private function loadController() {
        $controllerFile = __DIR__ . '/../controllers/' . $this->controllerName . '.php';
        
        if (file_exists($controllerFile)) {
            require_once $controllerFile;
            if (class_exists($this->controllerName)) {
                $this->controller = new $this->controllerName();
                return;
            }
        }
    }

    private function callMethod() {
        $controller = $this->controller;
        $method = $this->method;
        $params = $this->params;

        if (method_exists($controller, $method)) {
            if (!empty($params)) {
                call_user_func_array([$controller, $method], $params);
            } else {
                call_user_func([$controller, $method]);
            }
            return;
        }

        if ($controller instanceof CourseController) {
            $slug = $method;
            if (!empty($params)) {
                $slug = $params[0];
            }

            if (method_exists($controller, 'viewSlug')) {
                $controller->viewSlug($slug);
                return;
            }
        }

        http_response_code(404);
        echo "<h1>404 - Página não encontrada</h1>";
    }

}
