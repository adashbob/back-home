<?php


namespace Collectify\Services;


/**
 * Router the controller and the action
 *
 * Class Router
 * @package Collectify\Services *
 *
 */
class Router
{
    protected $parameters;
    protected $viewer;
    protected $controller;
    protected $action;
    protected $routes;
    protected $baseRoute;
    protected $route;

    public function __construct($routes = array()){
        $this->parameters = $_GET;
        $this->routes = $routes;
        if(isset($_SERVER['SCRIPT_NAME']))
            $this->baseRoute = $_SERVER['SCRIPT_NAME'];
        else
            $this->baseRoute = array();

        if(isset($_SERVER['PATH_INFO']))
            $this->route = $_SERVER['PATH_INFO'];
        else
            $this->route = array();

        $this->viewer     = new Viewer();
    }

    /**
     * get the controller and action and return a view
     */
    public function dispatch(){
        $viewParameters = $this->extractControllerAndActionParameter();
        $controllerParameters =  $this->executeAction();
        $this->viewer
            ->setViewParameters($viewParameters)
            ->setControllerParameters($controllerParameters)
            ->render();
    }

    /**
     * @return array
     * @throws \Exception
     */
    private function extractControllerAndActionParameter(){
        if($this->route){
            list($null, $module, $path) = explode("/", $this->route);
            if(array_key_exists($module, $this->routes)){
                $routeModule = $this->routes[$module];
                $basePah = '/'.$module;
                $path = '/'.$path;
                if($routeModule['basePath'] == $basePah && array_key_exists($path, $routeModule)){
                    list($this->controller, $this->action) = explode(':', $routeModule[$path]);
                }else{
                    throw new \Exception(sprintf("404 NOT FOUND La route %s n'exite pas", $routeModule));
                }
            }
            else throw new \Exception('La clé module \'est pas définie');
        }else{
            $this->controller =  array_key_exists('controller', $this->parameters) ? $this->parameters['controller'] : DEFAULT_CONTROLLER;
            $this->action =  array_key_exists('action', $this->parameters) ? $this->parameters['action'] : DEFAULT_ACTION;
        }
        return array($this->controller, $this->action);
    }

    /**
     * Execute the controller's action
     * @throws \Exception
     */
    public function executeAction(){
        $controllerClass = sprintf('\\Collectify\\Controller\\%sController', ucfirst($this->controller));
        if(!class_exists($controllerClass)){
            throw new \Exception("Controller $controllerClass not found");
        }
        $controller = new $controllerClass();

        $action = sprintf('%sAction', $this->action);
        if(!method_exists($controller, $action)){
            throw new \Exception("Action $action not exist on $controllerClass");
        }

        $this->cleanGetParameters();

        // Call $controller->$action($this->$parameters)
        return call_user_func_array(array($controller, $action), $this->parameters);
    }

    /**
     * Clean controller et action parametes in $_GET[]
     */
    public function cleanGetParameters()
    {
        switch (true){
            case array_key_exists('controller', $this->parameters):
                unset($this->parameters['controller']);
            case array_key_exists('action', $this->parameters):
                unset($this->parameters['action']);
        }
    }

}