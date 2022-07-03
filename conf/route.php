<?php

class Routing
{

    public static function buildRoute() {

        /* Контроллер и action по умолчанию */
        $controllerName = "IndexController";
        $modelName = "IndexModel";
        $action = "index";
        $slug = '';

        $route = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

        $i = count($route)-1;

        if ($route[1] != '') {
            $controllerName = ucfirst($route[1]) . "Controller";
            $modelName =  ucfirst($route[1]) . "Model";
        } 
        if (!empty($route[2]) && $route[2] != '') {
            $action = $route[2];
        } 
        if (!empty($route[3]) && $route[3] != '') {
            $slug = $route[3];
        }
        
        if (is_file(CONTROLLER_PATH . $controllerName . ".php")) {
            require_once CONTROLLER_PATH . $controllerName . ".php";
            require_once MODEL_PATH . $modelName . ".php";
        } else {
            header("Location: /");
        }
        

        $controller = new $controllerName();
		$controller->$action($slug);

    }

    public function errorPage() {
        
    }

}