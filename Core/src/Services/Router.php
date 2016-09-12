<?php


namespace Core\Services;
use Core\Exception\Exception;


/**
 * Router the controller and the action
 *
 * Class Router
 * @package Collectify\Services *
 *
 */
class Router
{

    /**
     * Parameters $_GET
     * @var
     */
    protected $parameters;

    /**
     * @var Viewer
     */
    protected $viewer;

    /**
     * Controller's to execute
     * @var
     */
    protected $controller;

    /**
     * Action Controller to execute
     * @var
     */
    protected $action;

    /**
     * Content all routing of the apllication
     * @var array
     */
    protected $routes;

    /**
     * Route executed
     * @var array
     */
    protected $route;

    /**
     * Module
     * @var
     */
    protected $module;

    /**
     * @var Exception
     */
    protected $exception;

    /**
     * Router constructor.
     * @param array $routes
     */
    public function __construct($routes = array()){
        $this->parameters = $_GET;
        $this->routes = $routes;

        if(isset($_SERVER['PATH_INFO']))
            $this->route = $_SERVER['PATH_INFO'];
        else
            $this->route = array();

        $this->viewer     = new Viewer();
        $this->exception = new Exception();
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

    /*public function loadTwig(){
        \Twig_Autoloader::register();
        $loader = new Twig_Loader_Filesystem(sprintf('../src/%s/Views', $this->module));
    }*/

    /**
     * @return array
     * @throws \Exception
     */
    private function extractControllerAndActionParameter(){
        if($this->route){
            // $route = /category/add
            // $prefixRoute = /category
            // $path = /add
            list($null, $prefixRoute, $path) = explode("/", $this->route);
            if(array_key_exists($prefixRoute, $this->routes)){
                $routeInfo = $this->routes[$prefixRoute];
                $prefixRoute = '/'.$prefixRoute;
                $path = '/'.$path;
                if($routeInfo['module'] && $routeInfo['basePath'] == $prefixRoute && array_key_exists($path, $routeInfo)){
                    $this->module = $routeInfo['module'];
                    list($this->controller, $this->action) = explode(':', $routeInfo[$path]);
                }else{
                    $this->exception->notFound();
                }
            }
            else $this->exception->notFound();
        }else{
            $this->controller =  array_key_exists('controller', $this->parameters) ? $this->parameters['controller'] : DEFAULT_CONTROLLER;
            $this->action =  array_key_exists('action', $this->parameters) ? $this->parameters['action'] : DEFAULT_ACTION;
        }
        return array($this->controller, $this->action, $this->module);
    }

    /**
     * Execute the controller's action
     * @throws \Exception
     */
    public function executeAction(){
        $controllerClass = sprintf('\\%s\\Controller\\%sController', $this->module, ucfirst($this->controller));
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